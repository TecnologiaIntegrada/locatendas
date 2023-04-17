SELECT setval('anotacoes_id_nota_seq', coalesce(max(id_nota),0) + 1, false) FROM anotacoes;
SELECT setval('clientes_id_cliente_seq', coalesce(max(id_cliente),0) + 1, false) FROM clientes;
SELECT setval('projetos_id_projetos_seq', coalesce(max(id_projetos),0) + 1, false) FROM projetos;
SELECT setval('tipos_de_nota_id_tipo_nota_seq', coalesce(max(id_tipo_nota),0) + 1, false) FROM tipos_de_nota;