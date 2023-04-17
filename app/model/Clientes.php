<?php

class Clientes extends TRecord
{
    const TABLENAME  = 'clientes';
    const PRIMARYKEY = 'id_cliente';
    const IDPOLICY   =  'serial'; // {max, serial}

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('nome_do_cliente');
            
    }

    /**
     * Method getProjetoss
     */
    public function getProjetoss()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('id_cliente', '=', $this->id_cliente));
        return Projetos::getObjects( $criteria );
    }

    public function set_projetos_cliente_to_string($projetos_cliente_to_string)
    {
        if(is_array($projetos_cliente_to_string))
        {
            $values = Clientes::where('id_cliente', 'in', $projetos_cliente_to_string)->getIndexedArray('id_cliente', 'id_cliente');
            $this->projetos_cliente_to_string = implode(', ', $values);
        }
        else
        {
            $this->projetos_cliente_to_string = $projetos_cliente_to_string;
        }

        $this->vdata['projetos_cliente_to_string'] = $this->projetos_cliente_to_string;
    }

    public function get_projetos_cliente_to_string()
    {
        if(!empty($this->projetos_cliente_to_string))
        {
            return $this->projetos_cliente_to_string;
        }
    
        $values = Projetos::where('id_cliente', '=', $this->id_cliente)->getIndexedArray('id_cliente','{cliente->id_cliente}');
        return implode(', ', $values);
    }

    
}

