<?php defined('BASEPATH') OR exit('No direct script access allowed');

// controller base
class MY_Controller extends CI_Controller {
    
    // médoto construtor
    public function __construct() {
        parent::__construct();
        $this->load->library( 'Template' );
        $this->template->set( 'container', 'inicio' );
        $this->load->library( 'Guard' );

        // verifica se esta logado
        if ( $this->guard->logged() ) {
            $this->template->use_module( 'dashboard' );
            $this->verificaStatus();
            $this->verificaPlano();
        }
    }

    private function verificaPlano() {

        // carrega as models necessárias
        $this->load->model( [ 'Cobrancas_model', 'Usuarios_model', 'Planos_model' ] );

        // carrega a libray de pagamento
        $this->load->library( 'Pagamentos' );

        // pega o codigo do usuario logado
        $Usuario = $this->guard->item('CodUsuario');

        $Plano = $this->Planos_model->getById( $this->guard->item('CodPlano') );

        $PlanoPadrao = $this->Planos_model->obterPlanoPadrao();

        if ( !$this->guard->item('CodPlano') ) {
            
            // assina o plano
            $this->Usuarios_model->assinarPlano( $Usuario, $PlanoPadrao['CodPlano'] );

            return false;
        }

        if ( !$this->guard->item('DataVencimento') ) return false;
        
        if ( time() > strtotime($this->guard->item('DataVencimento')) ){


            // assina o plano
            $this->Usuarios_model->assinarPlano( $Usuario, $PlanoPadrao['CodPlano'] );
            
            // atribui os dados do moip referente ao novo pagamento
            $dadosMoip = $this->pagamentos->novoPagamento( $Plano );

            // seta o id do pagamento
            $Plano['IdPagamento'] = $dadosMoip['IdPagamento'];

            // seta o link para realizar o pagamento
            $Plano['Link'] = $dadosMoip['Link'];

            // seta o token
            $Plano['Token'] = $dadosMoip['Token'];

            // cria a cobranca
            $this->Cobrancas_model->gerarCobranca( $Plano, $Usuario );

            // atualiza os dados do guard
            $this->guard->update();
        }

        return false;
    }

    // verifica status de pagamento caso o usuario tenha alguma cobrança em aberto
    private function verificaStatus() {
        
        // pega o codigo do usuario logado
        $Usuario = $this->guard->item('CodUsuario');

        // carrega as models necessárias
        $this->load->model( [ 'Cobrancas_model', 'Usuarios_model', 'Planos_model' ] );

        // carrega a libray de pagamento
        $this->load->library( 'Pagamentos' );

        // verifica se existe alguma cobranca em aberto
        $cobranca = $this->Cobrancas_model->obterCobrancaAberta( $Usuario );

        if ( !$cobranca ) return false;

        // pega o status de pagamento da cobranca em aberto
        $Status = $this->pagamentos->consultarStatusPagamento($cobranca['Token']);

        // verifica se o status esta cancelado
        if ( $Status == 'Cancelado' ) {

            // cancela a cobranca
            $this->Cobrancas_model->cancelarCobranca( $cobranca['CodCobranca'] );
            return false;            
        }

        // verifica se o status esta concluido
        if ( $Status == 'Concluido' ) {

            // altera o status para pago
            $this->Cobrancas_model->pagarCobranca( $cobranca['CodCobranca'] );

            // pega a periodicidade do plano adquirido
            $Periodicidade = $this->Planos_model->getById( $cobranca['CodPlano'] )['Recorrencia'];

            // verifica se a periodicidade e mensal
            if ( $Periodicidade == 'M' )
                $dataVencimento = time() + 30*24*60*60;
            
            // verifica se a periodicidade e trimestral
            if ( $Periodicidade == 'T' )
                $dataVencimento = time() + 3*30*24*60*60;

            // verifica se a periodicidade e semestral            
            if ( $Periodicidade == 'S' )
                $dataVencimento = time() + 6*30*24*60*60;

            // verifica se a periodicidade e anual
            if ( $Periodicidade == 'A' )
                $dataVencimento = time() + 12*30*24*60*60;

            // assina o plano
            $this->Usuarios_model->assinarPlano( $Usuario, $cobranca['CodPlano'], $dataVencimento );

            // atualiza os dados do guard
            $this->guard->update();

            return false;        
        }
    }
}

/* end of file */