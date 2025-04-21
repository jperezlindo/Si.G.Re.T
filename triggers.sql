DELIMITER $$
CREATE TRIGGER empresa AFTER UPDATE ON empresas FOR EACH ROW
  BEGIN
    INSERT INTO auditorias (user_empresa, tabla, accion, new_data, old_data,fecha_hora) 
    Values (
      NEW.au, 
      'empresas', 
      'UPDATE',
      CONCAT_WS('|s.g.r.t|','ID', OLD.id, 'NOMBRE', NEW.name, 'RAZON SOCIAL', NEW.razon_social, 'CUIT', NEW.cuit, 'TELEFONO', NEW.tel, 'CELULAR', NEW.cel, 'EMAIL', NEW.email, 'DIRECCION', NEW.direccion, 'RUBRO', NEW.rubro, 'LOGO', NEW.logo, 'ACTIVO', NEW.activo, 'ID CIUDAD', NEW.ciudad_id),
      CONCAT_WS('|s.g.r.t|','ID', OLD.id, 'NOMBRE', OLD.name, 'RAZON SOCIAL', OLD.razon_social, 'CUIT', OLD.cuit, 'TELEFONO', OLD.tel, 'CELULAR', OLD.cel, 'EMAIL', OLD.email, 'DIRECCION', OLD.direccion, 'RUBRO', OLD.rubro, 'LOGO', OLD.logo, 'ACTIVO', OLD.activo, 'ID CIUDAD', OLD.ciudad_id),
      NOW()
    );
  END; $$

DELIMITER $$  
CREATE TRIGGER torneo_insert AFTER INSERT ON torneos FOR EACH ROW
  BEGIN
  INSERT INTO auditorias (user_empresa, tabla, accion, new_data, old_data, fecha_hora) 
  Values (
    NEW.au, 
    'torneos', 
    'INSERT',
    CONCAT_WS('|s.g.r.t|','ID', NEW.id, 'NOMBRE', NEW.name, 'DESDE', NEW.f_desde, 'HASTA', NEW.f_hasta, 'HORA', NEW.hora, 'INICIA', NEW.ini_ins, 'FINALIZA', NEW.fin_ins, 'DESCRIPCION', NEW.descripcion, 'ACTIVO', NEW.activo, 'FINALIZADO', NEW.finalizado, 'TIPO DE TORNEO', NEW.tipo_torneo_id),
    CONCAT_WS('|s.g.r.t|','ID', NEW.id, 'NOMBRE', NEW.name, 'DESDE', NEW.f_desde, 'HASTA', NEW.f_hasta, 'HORA', NEW.hora, 'INICIA', NEW.ini_ins, 'FINALIZA', NEW.fin_ins, 'DESCRIPCION', NEW.descripcion, 'ACTIVO', NEW.activo, 'FINALIZADO', NEW.finalizado, 'TIPO DE TORNEO', NEW.tipo_torneo_id),
    NOW()
  );
  END; $$

DELIMITER $$
CREATE TRIGGER torneo_update AFTER UPDATE ON torneos FOR EACH ROW
  BEGIN 
    DECLARE accion varchar(30);
    IF NEW.activo = 1 THEN
     SET accion = 'UPDATE';
    ELSE
     SET accion = 'DELETE';
    END IF;
    INSERT INTO auditorias (user_empresa, tabla, accion, new_data, old_data,fecha_hora) 
    Values (
      NEW.au, 
      'torneos', 
      accion,
      CONCAT_WS('|s.g.r.t|','ID', NEW.id, 'NOMBRE', NEW.name, 'DESDE', NEW.f_desde, 'HASTA', NEW.f_hasta, 'HORA', NEW.hora, 'INICIA', NEW.ini_ins, 'FINALIZA', NEW.fin_ins, 'DESCRIPCION', NEW.descripcion, 'ACTIVO', NEW.activo, 'FINALIZADO', NEW.finalizado, 'TIPO DE TORNEO', NEW.tipo_torneo_id),
      CONCAT_WS('|s.g.r.t|','ID', OLD.id, 'NOMBRE', OLD.name, 'DESDE', OLD.f_desde, 'HASTA', OLD.f_hasta, 'HORA', OLD.hora, 'INICIA', OLD.ini_ins, 'FINALIZA', OLD.fin_ins, 'DESCRIPCION', OLD.descripcion, 'ACTIVO', OLD.activo, 'FINALIZADO', OLD.finalizado, 'TIPO DE TORNEO', OLD.tipo_torneo_id),
      NOW()
    );
  END;$$

DELIMITER $$
CREATE TRIGGER detalles_reserva_update AFTER UPDATE ON detalles_reserva FOR EACH ROW
  BEGIN 
    DECLARE accion varchar(30);
    IF NEW.activo = 1 THEN
     SET accion = 'UPDATE';
    ELSE
     SET accion = 'DELETE';
    END IF;
    INSERT INTO auditorias (user_empresa, tabla, accion, new_data, old_data, fecha_hora) 
    Values (
      NEW.au, 
      'detalles_reserva', 
      accion,
      CONCAT_WS('|s.g.r.t|', 'ID',NEW.id, 'FECHA RESERVADA', NEW.fecha_reservada, 'HORA RESERVADA', NEW.hr_reservada, 'CANTIDAD HS', NEW.cant_hs, 'MONTO', NEW.monto, 'ACTIVO', NEW.activo, 'CONFIRMADA', NEW.confirmada),
      CONCAT_WS('|s.g.r.t|', 'ID',OLD.id, 'FECHA RESERVADA', OLD.fecha_reservada, 'HORA RESERVADA', OLD.hr_reservada, 'CANTIDAD HS', OLD.cant_hs, 'MONTO', OLD.monto, 'ACTIVO', OLD.activo, 'CONFIRMADA', OLD.confirmada),
      NOW()
    );
  END;$$

DELIMITER $$
CREATE TRIGGER user_empresa_insert AFTER INSERT ON user_empresa FOR EACH ROW
  BEGIN
  INSERT INTO auditorias (user_empresa, tabla, accion, new_data, old_data, fecha_hora) 
  Values (
    NEW.au, 
    'user_empresa', 
    'INSERT',
    CONCAT_WS('|s.g.r.t|', 'ID',NEW.id, 'ACTIVO', NEW.activo, 'USER ID', NEW.user_id, 'EMPRESA ID', NEW.empresa_id, 'ROL ID', NEW.rol_id),
    CONCAT_WS('|s.g.r.t|', 'ID',NEW.id, 'ACTIVO', NEW.activo, 'USER ID', NEW.user_id, 'EMPRESA ID', NEW.empresa_id, 'ROL ID', NEW.rol_id),
    NOW()
  );
  END; $$

DELIMITER $$
CREATE TRIGGER user_empresa_update AFTER UPDATE ON user_empresa FOR EACH ROW
  BEGIN 
    DECLARE accion varchar(30);
    IF NEW.activo = 1 THEN
     SET accion = 'UPDATE';
    ELSE
     SET accion = 'DELETE';
    END IF;
    INSERT INTO auditorias (user_empresa, tabla, accion, new_data, old_data, fecha_hora) 
    Values (
      NEW.au, 
      'user_empresa', 
      accion,
      CONCAT_WS('|s.g.r.t|', 'ID',NEW.id, 'ACTIVO', NEW.activo, 'USER ID', NEW.user_id, 'EMPRESA ID', NEW.empresa_id, 'ROL ID', NEW.rol_id),
      CONCAT_WS('|s.g.r.t|', 'ID',OLD.id, 'ACTIVO', OLD.activo, 'USER ID', OLD.user_id, 'EMPRESA ID', OLD.empresa_id, 'ROL ID', OLD.rol_id),
      NOW()
    );
  END;$$

DELIMITER $$
CREATE TRIGGER user_update AFTER UPDATE ON users FOR EACH ROW
  BEGIN 
    DECLARE accion varchar(30);
    IF NEW.activo = 1 THEN
     SET accion = 'UPDATE';
    ELSE
     SET accion = 'DELETE';
    END IF;
    INSERT INTO auditorias (user_empresa, tabla, accion, new_data, old_data, fecha_hora) 
    Values (
      NEW.au, 
      'users', 
      accion,
      CONCAT_WS('|s.g.r.t|','USER', NEW.user, 'DNI', NEW.dni, 'APELLIDO', NEW.apellido, 'NOMBRE', NEW.name, 'FECHA NACIMIENTO', NEW.fecha_nacimiento, 'EMAIL', NEW.email, 'CELULAR', NEW.cel, 'DIRECCION', NEW.direccion, 'SEXO', NEW.sexo, 'PASS', NEW.password, 'FOTO', NEW.foto, 'ACTIVO', NEW.activo, 'CATEGORIA', NEW.categoria ),
      CONCAT_WS('|s.g.r.t|','USER', OLD.user, 'DNI', OLD.dni, 'APELLIDO', OLD.apellido, 'NOMBRE', OLD.name, 'FECHA NACIMIENTO', OLD.fecha_nacimiento, 'EMAIL', OLD.email, 'CELULAR', OLD.cel, 'DIRECCION', OLD.direccion, 'SEXO', OLD.sexo, 'PASS', OLD.password, 'FOTO', OLD.foto, 'ACTIVO', OLD.activo, 'CATEGORIA', OLD.categoria ),
      NOW()
    );
  END;$$

DELIMITER $$
CREATE TRIGGER categoria_torneo_insert AFTER INSERT ON categorias_torneo FOR EACH ROW
  BEGIN
  INSERT INTO auditorias (user_empresa, tabla, accion, new_data, old_data, fecha_hora) 
  Values (
    NEW.au, 
    'categorias_torneo', 
    'INSERT',
    CONCAT_WS('|s.g.r.t|','ID', NEW.id, 'Nro. PTES', NEW.n_ptes, 'VALOR', NEW.valor, 'CUPO', NEW.cupo, 'ACTIVO', NEW.activo, 'DESCRIPCION', NEW.descripcion, 'CAMPEON', NEW.campeon, 'SUBCAMPEON', NEW.subcampeon, 'SEMIFINAL', NEW.semifinal, 'CUARTOS', NEW.cuartos, 'OCTAVOS', NEW.octavos, 'ID CATEGORIA', NEW.categoria_id, 'ID TORNEO', NEW.torneo_id),
    CONCAT_WS('|s.g.r.t|','ID', NEW.id, 'Nro. PTES', NEW.n_ptes, 'VALOR', NEW.valor, 'CUPO', NEW.cupo, 'ACTIVO', NEW.activo, 'DESCRIPCION', NEW.descripcion, 'CAMPEON', NEW.campeon, 'SUBCAMPEON', NEW.subcampeon, 'SEMIFINAL', NEW.semifinal, 'CUARTOS', NEW.cuartos, 'OCTAVOS', NEW.octavos, 'ID CATEGORIA', NEW.categoria_id, 'ID TORNEO', NEW.torneo_id),
    NOW()
  );
  END; $$

DELIMITER $$
CREATE TRIGGER categoria_torneo_delete AFTER DELETE ON categorias_torneo FOR EACH ROW
  BEGIN
  INSERT INTO auditorias (user_empresa, tabla, accion, new_data, old_data, fecha_hora) 
  Values (
    OLD.au, 
    'categorias_torneo', 
    'DELETE',
    CONCAT_WS('|s.g.r.t|','ID', OLD.id, 'Nro. PTES', OLD.n_ptes, 'VALOR', OLD.valor, 'CUPO', OLD.cupo, 'ACTIVO', OLD.activo, 'DESCRIPCION', OLD.descripcion, 'CAMPEON', OLD.campeon, 'SUBCAMPEON', OLD.subcampeon, 'SEMIFINAL', OLD.semifinal, 'CUARTOS', OLD.cuartos, 'OCTAVOS', OLD.octavos, 'ID CATEGORIA', OLD.categoria_id, 'ID TORNEO', OLD.torneo_id),
    CONCAT_WS('|s.g.r.t|','ID', OLD.id, 'Nro. PTES', OLD.n_ptes, 'VALOR', OLD.valor, 'CUPO', OLD.cupo, 'ACTIVO', OLD.activo, 'DESCRIPCION', OLD.descripcion, 'CAMPEON', OLD.campeon, 'SUBCAMPEON', OLD.subcampeon, 'SEMIFINAL', OLD.semifinal, 'CUARTOS', OLD.cuartos, 'OCTAVOS', OLD.octavos, 'ID CATEGORIA', OLD.categoria_id, 'ID TORNEO', OLD.torneo_id),
    NOW()
  );
  END; $$

DELIMITER $$
CREATE TRIGGER categoria_torneo_update AFTER UPDATE ON categorias_torneo FOR EACH ROW
  BEGIN 
    DECLARE accion varchar(30);
    IF NEW.activo = 1 THEN
     SET accion = 'UPDATE';
    ELSE
     SET accion = 'DELETE';
    END IF;
    INSERT INTO auditorias (user_empresa, tabla, accion, new_data, old_data,fecha_hora) 
    Values (
      NEW.au, 
      'categorias_torneo', 
      accion,
      CONCAT_WS('|s.g.r.t|','ID', NEW.id, 'Nro. PTES', NEW.n_ptes, 'VALOR', NEW.valor, 'CUPO', NEW.cupo, 'ACTIVO', NEW.activo, 'DESCRIPCION', NEW.descripcion, 'CAMPEON', NEW.campeon, 'SUBCAMPEON', NEW.subcampeon, 'SEMIFINAL', NEW.semifinal, 'CUARTOS', NEW.cuartos, 'OCTAVOS', NEW.octavos, 'ID CATEGORIA', NEW.categoria_id, 'ID TORNEO', NEW.torneo_id),
      CONCAT_WS('|s.g.r.t|','ID', OLD.id, 'Nro. PTES', OLD.n_ptes, 'VALOR', OLD.valor, 'CUPO', OLD.cupo, 'ACTIVO', OLD.activo, 'DESCRIPCION', OLD.descripcion, 'CAMPEON', OLD.campeon, 'SUBCAMPEON', OLD.subcampeon, 'SEMIFINAL', OLD.semifinal, 'CUARTOS', OLD.cuartos, 'OCTAVOS', OLD.octavos, 'ID CATEGORIA', OLD.categoria_id, 'ID TORNEO', OLD.torneo_id),
      NOW()
    );
  END;$$

DELIMITER $$
CREATE TRIGGER partido_insert AFTER INSERT ON partidos FOR EACH ROW
  BEGIN
  INSERT INTO auditorias (user_empresa, tabla, accion, new_data, old_data, fecha_hora) 
  Values (
    NEW.au, 
    'partidos', 
    'INSERT',
    CONCAT_WS('|s.g.r.t|','ID', NEW.id, 'NOMBRE', NEW.name, 'CANCHA', NEW.cancha, 'FECHA', NEW.fecha, 'INICIO', NEW.hr_ini, 'FINALIZO', NEW.hr_fin, 'ACTIVO', NEW.activo, 'FINALIZADO', NEW.finalizado),
    CONCAT_WS('|s.g.r.t|','ID', NEW.id, 'NOMBRE', NEW.name, 'CANCHA', NEW.cancha, 'FECHA', NEW.fecha, 'INICIO', NEW.hr_ini, 'FINALIZO', NEW.hr_fin, 'ACTIVO', NEW.activo, 'FINALIZADO', NEW.finalizado),
    NOW()
  );
  END; $$

DELIMITER $$
CREATE TRIGGER partidos_update AFTER UPDATE ON partidos FOR EACH ROW
  BEGIN 
    DECLARE accion varchar(30);
    IF NEW.activo = 1 THEN
     SET accion = 'UPDATE';
    ELSE
     SET accion = 'UPDATE/FINALIZADO';
    END IF;
    INSERT INTO auditorias (user_empresa, tabla, accion, new_data, old_data,fecha_hora) 
    Values (
      NEW.au, 
      'partidos', 
      accion,
      CONCAT_WS('|s.g.r.t|','ID', NEW.id, 'NOMBRE', NEW.name, 'CANCHA', NEW.cancha, 'FECHA', NEW.fecha, 'INICIO', NEW.hr_ini, 'FINALIZO', NEW.hr_fin, 'ACTIVO', NEW.activo, 'FINALIZADO', NEW.finalizado),
      CONCAT_WS('|s.g.r.t|','ID', OLD.id, 'NOMBRE', OLD.name, 'CANCHA', OLD.cancha, 'FECHA', OLD.fecha, 'INICIO', OLD.hr_ini, 'FINALIZO', OLD.hr_fin, 'ACTIVO', OLD.activo, 'FINALIZADO', OLD.finalizado),
      NOW()
    );
  END;$$

DELIMITER $$
CREATE TRIGGER detalle_partido_insert AFTER INSERT ON detalle_partido FOR EACH ROW
  BEGIN
  INSERT INTO auditorias (user_empresa, tabla, accion, new_data, old_data, fecha_hora) 
  Values (
    NEW.au, 
    'detalle_partido', 
    'INSERT',
    CONCAT_WS('|s.g.r.t|','ID', NEW.id, 'SET 1', NEW.set_01, 'SET 2', NEW.set_02, 'SET 3', NEW.set_03, 'COMENTARIO', NEW.comentario, 'GANADOR', NEW.isWinn, 'ID EQUIPO', NEW.equipo_id, 'ID PARTIDO', NEW.partido_id, 'ACTIVO', NEW.activo),
    CONCAT_WS('|s.g.r.t|','ID', NEW.id, 'SET 1', NEW.set_01, 'SET 2', NEW.set_02, 'SET 3', NEW.set_03, 'COMENTARIO', NEW.comentario, 'GANADOR', NEW.isWinn, 'ID EQUIPO', NEW.equipo_id, 'ID PARTIDO', NEW.partido_id, 'ACTIVO', NEW.activo),
    NOW()
  );
  END; $$

DELIMITER $$
CREATE TRIGGER detalle_partido_update AFTER UPDATE ON detalle_partido FOR EACH ROW
  BEGIN 
    DECLARE accion varchar(30);
    IF NEW.activo = 1 THEN
     SET accion = 'UPDATE';
    ELSE
     SET accion = 'UPDATE/FINALIZADO';
    END IF;
    INSERT INTO auditorias (user_empresa, tabla, accion, new_data, old_data,fecha_hora) 
    Values (
      NEW.au, 
      'detalle_partido', 
      accion,
      CONCAT_WS('|s.g.r.t|','ID', NEW.id, 'SET 1', NEW.set_01, 'SET 2', NEW.set_02, 'SET 3', NEW.set_03, 'COMENTARIO', NEW.comentario, 'GANADOR', NEW.isWinn, 'ID EQUIPO', NEW.equipo_id, 'ID PARTIDO', NEW.partido_id, 'ACTIVO', NEW.activo),
      CONCAT_WS('|s.g.r.t|','ID', OLD.id, 'SET 1', OLD.set_01, 'SET 2', OLD.set_02, 'SET 3', OLD.set_03, 'COMENTARIO', OLD.comentario, 'GANADOR', OLD.isWinn, 'ID EQUIPO', OLD.equipo_id, 'ID PARTIDO', OLD.partido_id, 'ACTIVO', OLD.activo),
      NOW()
    );
  END;$$
