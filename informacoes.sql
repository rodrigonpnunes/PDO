-- ---------------------------------
 CREATE TABLE tab_usuario (
    deslogin character varying(50),
    desenha character varying(50)
);
 -- ---------------------------------


CREATE OR REPLACE FUNCTION sp_usuarios_insert(char,char)
  RETURNS integer AS
$BODY$
DECLARE
  login ALIAS FOR $1;
  senha ALIAS FOR $2;
BEGIN
	INSERT INTO tab_usuario VALUES (login,senha);
END;
$BODY$
LANGUAGE 'plpgsql' VOLATILE;

