CREATE TABLE anotacoes( 
      id_nota number(10)    NOT NULL , 
      descricao_do_item varchar  (128)    NOT NULL , 
      detalhas_da_nota varchar(3000)   , 
      data_de_execucao timestamp(0)   , 
      id_projetos number(10)   , 
      id_tipo_nota number(10)   , 
 PRIMARY KEY (id_nota)) ; 

CREATE TABLE clientes( 
      id_cliente number(10)    NOT NULL , 
      nome_do_cliente varchar  (68)    NOT NULL , 
 PRIMARY KEY (id_cliente)) ; 

CREATE TABLE projetos( 
      id_projetos number(10)    NOT NULL , 
      referencia varchar  (250)   , 
      nome_do_evento varchar  (64)    NOT NULL , 
      data_do_evento timestamp(0)   , 
      descricao_do_evento varchar(3000)   , 
      entrada_via_web number(10)   , 
      data_montagem timestamp(0)   , 
      data_desmotagem timestamp(0)   , 
      id_cliente number(10)   , 
 PRIMARY KEY (id_projetos)) ; 

CREATE TABLE tipos_de_nota( 
      id_tipo_nota number(10)    NOT NULL , 
      tipo_de_nota varchar  (150)    NOT NULL , 
 PRIMARY KEY (id_tipo_nota)) ; 

 
  
 ALTER TABLE anotacoes ADD CONSTRAINT fk_anotacoes_projetos FOREIGN KEY (id_projetos) references projetos(id_projetos); 
ALTER TABLE anotacoes ADD CONSTRAINT fk_tipos_nota FOREIGN KEY (id_tipo_nota) references tipos_de_nota(id_tipo_nota); 
ALTER TABLE projetos ADD CONSTRAINT fk_projetos_1_clientes FOREIGN KEY (id_cliente) references clientes(id_cliente); 
 CREATE SEQUENCE anotacoes_id_nota_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER anotacoes_id_nota_seq_tr 

BEFORE INSERT ON anotacoes FOR EACH ROW 

WHEN 

(NEW.id_nota IS NULL) 

BEGIN 

SELECT anotacoes_id_nota_seq.NEXTVAL INTO :NEW.id_nota FROM DUAL; 

END;
CREATE SEQUENCE clientes_id_cliente_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER clientes_id_cliente_seq_tr 

BEFORE INSERT ON clientes FOR EACH ROW 

WHEN 

(NEW.id_cliente IS NULL) 

BEGIN 

SELECT clientes_id_cliente_seq.NEXTVAL INTO :NEW.id_cliente FROM DUAL; 

END;
CREATE SEQUENCE projetos_id_projetos_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER projetos_id_projetos_seq_tr 

BEFORE INSERT ON projetos FOR EACH ROW 

WHEN 

(NEW.id_projetos IS NULL) 

BEGIN 

SELECT projetos_id_projetos_seq.NEXTVAL INTO :NEW.id_projetos FROM DUAL; 

END;
CREATE SEQUENCE tipos_de_nota_id_tipo_nota_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER tipos_de_nota_id_tipo_nota_seq_tr 

BEFORE INSERT ON tipos_de_nota FOR EACH ROW 

WHEN 

(NEW.id_tipo_nota IS NULL) 

BEGIN 

SELECT tipos_de_nota_id_tipo_nota_seq.NEXTVAL INTO :NEW.id_tipo_nota FROM DUAL; 

END;
 
  
