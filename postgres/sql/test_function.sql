CREATE OR REPLACE FUNCTION show_function_definition(IN param_name TEXT) 
RETURNS TABLE(func_name NAME, definition TEXT) AS 
$$
	BEGIN 
		RETURN QUERY
			SELECT proname, prosrc FROM pg_proc pp 
				WHERE pp.proname LIKE CONCAT('%', param_name, '%');
	END;
$$ 
LANGUAGE plpgsql;

SELECT * FROM show_function_definition ('get_latest_film');

DROP FUNCTION show_function_definition;