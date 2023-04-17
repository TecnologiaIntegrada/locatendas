<?php

class AnotacoesForm extends TPage
{
    protected $form;
    private $formFields = [];
    private static $database = 'locatendas';
    private static $activeRecord = 'Anotacoes';
    private static $primaryKey = 'id_nota';
    private static $formName = 'form_AnotacoesForm';

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
        $this->form->setFormTitle("Registration of anotacoes");


        $id_nota = new TEntry('id_nota');
        $descricao_do_item = new TEntry('descricao_do_item');
        $detalhas_da_nota = new TEntry('detalhas_da_nota');
        $data_de_execucao = new TDateTime('data_de_execucao');
        $id_projetos = new TDBCombo('id_projetos', 'locatendas', 'Projetos', 'id_projetos', '{id_projetos}','id_projetos asc'  );
        $id_tipo_nota = new TDBCombo('id_tipo_nota', 'locatendas', 'TiposDeNota', 'id_tipo_nota', '{id_tipo_nota}','id_tipo_nota asc'  );

        $descricao_do_item->addValidation("Descricao do item", new TRequiredValidator()); 

        $id_nota->setEditable(false);
        $descricao_do_item->setMaxLength(128);
        $data_de_execucao->setMask('dd/mm/yyyy hh:ii');
        $data_de_execucao->setDatabaseMask('yyyy-mm-dd hh:ii');
        $id_projetos->enableSearch();
        $id_tipo_nota->enableSearch();

        $id_nota->setSize(100);
        $id_projetos->setSize('100%');
        $id_tipo_nota->setSize('100%');
        $data_de_execucao->setSize(150);
        $detalhas_da_nota->setSize('100%');
        $descricao_do_item->setSize('100%');



        $row1 = $this->form->addFields([new TLabel("Id nota:", null, '14px', null)],[$id_nota]);
        $row2 = $this->form->addFields([new TLabel("Descricao do item:", '#ff0000', '14px', null)],[$descricao_do_item]);
        $row3 = $this->form->addFields([new TLabel("Detalhas da nota:", null, '14px', null)],[$detalhas_da_nota]);
        $row4 = $this->form->addFields([new TLabel("Data de execucao:", null, '14px', null)],[$data_de_execucao]);
        $row5 = $this->form->addFields([new TLabel("Id projetos:", null, '14px', null)],[$id_projetos]);
        $row6 = $this->form->addFields([new TLabel("Id tipo nota:", null, '14px', null)],[$id_tipo_nota]);

        // create the form actions
        $btn_onsave = $this->form->addAction("Save", new TAction([$this, 'onSave']), 'fas:save #ffffff');
        $this->btn_onsave = $btn_onsave;
        $btn_onsave->addStyleClass('btn-primary'); 

        $btn_onclear = $this->form->addAction("Clear form", new TAction([$this, 'onClear']), 'fas:eraser #dd5a43');
        $this->btn_onclear = $btn_onclear;

        $btn_onshow = $this->form->addAction("Back", new TAction(['AnotacoesList', 'onShow']), 'fas:arrow-left #000000');
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

            $object = new Anotacoes(); // create an empty object 

            $data = $this->form->getData(); // get form data as array
            $object->fromArray( (array) $data); // load the object with data

            $object->store(); // save the object 

            $loadPageParam = [];

            if(!empty($param['target_container']))
            {
                $loadPageParam['target_container'] = $param['target_container'];
            }

            // get the generated {PRIMARY_KEY}
            $data->id_nota = $object->id_nota; 

            $this->form->setData($data); // fill form data
            TTransaction::close(); // close the transaction

            TToast::show('success', "Registro salvo", 'topRight', 'far:check-circle');
            TApplication::loadPage('AnotacoesList', 'onShow', $loadPageParam); 

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

                $object = new Anotacoes($key); // instantiates the Active Record 

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

