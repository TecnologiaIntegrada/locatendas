<?php

class ProjetosForm extends TPage
{
    protected $form;
    private $formFields = [];
    private static $database = 'locatendas';
    private static $activeRecord = 'Projetos';
    private static $primaryKey = 'id_projetos';
    private static $formName = 'form_ProjetosForm';

    /**
     * Form constructor
     * @param $param Request
     */
    public function __construct( $param )
    {
        parent::__construct();

        if(!empty($param['target_container']))
        {
            $this->adianti_target_container = $param['target_container'];
        }

        // creates the form
        $this->form = new BootstrapFormBuilder(self::$formName);
        // define the form title
        $this->form->setFormTitle("Project Form");


        $id_projetos = new TEntry('id_projetos');
        $referencia = new TEntry('referencia');
        $nome_do_evento = new TEntry('nome_do_evento');
        $data_do_evento = new TDateTime('data_do_evento');
        $descricao_do_evento = new TEntry('descricao_do_evento');
        $entrada_via_web = new TEntry('entrada_via_web');
        $data_montagem = new TDateTime('data_montagem');
        $data_desmotagem = new TDateTime('data_desmotagem');
        $id_cliente = new TDBCombo('id_cliente', 'locatendas', 'Clientes', 'id_cliente', '{id_cliente}','id_cliente asc'  );

        $nome_do_evento->addValidation("Nome do evento", new TRequiredValidator()); 

        $id_projetos->setEditable(false);
        $id_cliente->enableSearch();
        $referencia->setMaxLength(250);
        $nome_do_evento->setMaxLength(64);

        $data_montagem->setMask('dd/mm/yyyy hh:ii');
        $data_do_evento->setMask('dd/mm/yyyy hh:ii');
        $data_desmotagem->setMask('dd/mm/yyyy hh:ii');

        $data_montagem->setDatabaseMask('yyyy-mm-dd hh:ii');
        $data_do_evento->setDatabaseMask('yyyy-mm-dd hh:ii');
        $data_desmotagem->setDatabaseMask('yyyy-mm-dd hh:ii');

        $id_projetos->setSize(100);
        $referencia->setSize('100%');
        $data_montagem->setSize(150);
        $id_cliente->setSize('100%');
        $data_do_evento->setSize(150);
        $data_desmotagem->setSize(150);
        $nome_do_evento->setSize('100%');
        $entrada_via_web->setSize('100%');
        $descricao_do_evento->setSize('100%');


        $row1 = $this->form->addFields([new TLabel("Id projetos:", null, '14px', null, '100%'),$id_projetos],[new TLabel("Referencia:", null, '14px', null, '100%'),$referencia]);
        $row1->layout = ['col-sm-6','col-sm-6'];

        $row2 = $this->form->addFields([new TLabel("Nome do evento:", '#ff0000', '14px', null, '100%'),$nome_do_evento],[new TLabel("Data do evento:", null, '14px', null, '100%'),$data_do_evento]);
        $row2->layout = ['col-sm-6','col-sm-6'];

        $row3 = $this->form->addFields([new TLabel("Descricao do evento:", null, '14px', null, '100%'),$descricao_do_evento],[new TLabel("Entrada via web:", null, '14px', null, '100%'),$entrada_via_web]);
        $row3->layout = ['col-sm-6','col-sm-6'];

        $row4 = $this->form->addFields([new TLabel("Data montagem:", null, '14px', null, '100%'),$data_montagem],[new TLabel("Data desmotagem:", null, '14px', null, '100%'),$data_desmotagem]);
        $row4->layout = ['col-sm-6','col-sm-6'];

        $row5 = $this->form->addFields([new TLabel("Id cliente:", null, '14px', null, '100%'),$id_cliente],[]);
        $row5->layout = ['col-sm-6','col-sm-6'];

        // create the form actions
        $btn_onsave = $this->form->addAction("Save", new TAction([$this, 'onSave']), 'fas:save #ffffff');
        $this->btn_onsave = $btn_onsave;
        $btn_onsave->addStyleClass('btn-primary'); 

        $btn_onclear = $this->form->addAction("Clear form", new TAction([$this, 'onClear']), 'fas:eraser #dd5a43');
        $this->btn_onclear = $btn_onclear;

        $btn_onshow = $this->form->addAction("Back", new TAction(['ProjetosList', 'onShow']), 'fas:arrow-left #000000');
        $this->btn_onshow = $btn_onshow;

        parent::setTargetContainer('adianti_right_panel');

        $btnClose = new TButton('closeCurtain');
        $btnClose->class = 'btn btn-sm btn-default';
        $btnClose->style = 'margin-right:10px;';
        $btnClose->onClick = "Template.closeRightPanel();";
        $btnClose->setLabel("Fechar");
        $btnClose->setImage('fas:times');

        $this->form->addHeaderWidget($btnClose);

        parent::add($this->form);

    }

    public function onSave($param = null) 
    {
        try
        {
            TTransaction::open(self::$database); // open a transaction

            $messageAction = null;

            $this->form->validate(); // validate form data

            $object = new Projetos(); // create an empty object 

            $data = $this->form->getData(); // get form data as array
            $object->fromArray( (array) $data); // load the object with data

            $object->store(); // save the object 

            $loadPageParam = [];

            if(!empty($param['target_container']))
            {
                $loadPageParam['target_container'] = $param['target_container'];
            }

            // get the generated {PRIMARY_KEY}
            $data->id_projetos = $object->id_projetos; 

            $this->form->setData($data); // fill form data
            TTransaction::close(); // close the transaction

            TToast::show('success', "Registro salvo", 'topRight', 'far:check-circle');
            TApplication::loadPage('ProjetosList', 'onShow', $loadPageParam); 

                        TScript::create("Template.closeRightPanel();"); 
        }
        catch (Exception $e) // in case of exception
        {
            //</catchAutoCode> 

            new TMessage('error', $e->getMessage()); // shows the exception error message
            $this->form->setData( $this->form->getData() ); // keep form data
            TTransaction::rollback(); // undo all pending operations
        }
    }

    public function onEdit( $param )
    {
        try
        {
            if (isset($param['key']))
            {
                $key = $param['key'];  // get the parameter $key
                TTransaction::open(self::$database); // open a transaction

                $object = new Projetos($key); // instantiates the Active Record 

                $this->form->setData($object); // fill the form 

                TTransaction::close(); // close the transaction 
            }
            else
            {
                $this->form->clear();
            }
        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage()); // shows the exception error message
            TTransaction::rollback(); // undo all pending operations
        }
    }

    /**
     * Clear form data
     * @param $param Request
     */
    public function onClear( $param )
    {
        $this->form->clear(true);

    }

    public function onShow($param = null)
    {

    } 

}

