<?php

class Anotacoes extends TRecord
{
    const TABLENAME  = 'anotacoes';
    const PRIMARYKEY = 'id_nota';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $projetos;
    private $tipo_nota;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('descricao_do_item');
        parent::addAttribute('detalhas_da_nota');
        parent::addAttribute('data_de_execucao');
        parent::addAttribute('id_projetos');
        parent::addAttribute('id_tipo_nota');
            
    }

    /**
     * Method set_projetos
     * Sample of usage: $var->projetos = $object;
     * @param $object Instance of Projetos
     */
    public function set_projetos(Projetos $object)
    {
        $this->projetos = $object;
        $this->id_projetos = $object->id_projetos;
    }

    /**
     * Method get_projetos
     * Sample of usage: $var->projetos->attribute;
     * @returns Projetos instance
     */
    public function get_projetos()
    {
    
        // loads the associated object
        if (empty($this->projetos))
            $this->projetos = new Projetos($this->id_projetos);
    
        // returns the associated object
        return $this->projetos;
    }
    /**
     * Method set_tipos_de_nota
     * Sample of usage: $var->tipos_de_nota = $object;
     * @param $object Instance of TiposDeNota
     */
    public function set_tipo_nota(TiposDeNota $object)
    {
        $this->tipo_nota = $object;
        $this->id_tipo_nota = $object->id_tipo_nota;
    }

    /**
     * Method get_tipo_nota
     * Sample of usage: $var->tipo_nota->attribute;
     * @returns TiposDeNota instance
     */
    public function get_tipo_nota()
    {
    
        // loads the associated object
        if (empty($this->tipo_nota))
            $this->tipo_nota = new TiposDeNota($this->id_tipo_nota);
    
        // returns the associated object
        return $this->tipo_nota;
    }

    
}

