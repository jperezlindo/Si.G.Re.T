INSERT INTO sigret.reservas(id, fija, dia, total, activo, confirmada, finalizada, abonada, au, user_empresa_id, created_at, updated_at) 
SELECT id, fija, dia, total, activo, confirmada, finalizada, abonada, au, user_empresa_id, created_at, updated_at FROM sigretback.reservas ;

INSERT INTO sigret.detalles_reserva (id, fecha_reservada, hr_reservada, cant_hs, monto, activo, confirmada, ca, au, reserva_id, created_at, updated_at) 
SELECT id, fecha_reservada, hr_reservada, cant_hs, monto, activo, confirmada, ca, au, reserva_id, created_at, updated_at FROM sigretback.detalles_reserva ;

INSERT INTO sigret.servicios_requeridos (id, precio, cancha_servicio_id, detalle_reserva_id, created_at, updated_at) 
SELECT id, precio, cancha_servicio_id, detalle_reserva_id, created_at, updated_at FROM sigretback.servicios_requeridos ;

INSERT INTO sigret.estado_detalle_reserva (id, comentario, estado_id, detalle_reserva_id, created_at, updated_at) 
SELECT id, comentario, estado_id, detalle_reserva_id, created_at, updated_at FROM sigretback.estado_detalle_reserva ;

INSERT INTO sigret.torneos (id, name, f_desde, f_hasta, hora, ini_ins, fin_ins, descripcion, activo, finalizado, em, tipo_torneo_id, user_empresa_id, au, created_at, updated_at ) 
SELECT id, name, f_desde, f_hasta, hora, ini_ins, fin_ins, descripcion, activo, finalizado, em, tipo_torneo_id, user_empresa_id, au, created_at, updated_at  FROM sigretback.torneos ;

INSERT INTO sigret.reservas_torneo (id, activo, torneo_id, detalle_reserva_id, created_at, updated_at) 
SELECT id, activo, torneo_id, detalle_reserva_id, created_at, updated_at FROM sigretback.reservas_torneo ;

INSERT INTO sigret.categorias_torneo (id, n_ptes, valor, cupo, activo, descripcion, winn, campeon, subcampeon, semifinal, cuartos, octavos, au, categoria_id, torneo_id, created_at, updated_at) 
SELECT id, n_ptes, valor, cupo, activo, descripcion, winn, campeon, subcampeon, semifinal, cuartos, octavos, au, categoria_id, torneo_id, created_at, updated_at FROM sigretback.categorias_torneo ;

INSERT INTO sigret.inscripciones (id, activo, categoria_torneo_id, user_empresa_id, equipo_id, au, created_at, updated_at) 
SELECT id, activo, categoria_torneo_id, user_empresa_id, equipo_id, au, created_at, updated_at FROM sigretback.inscripciones ;

INSERT INTO sigret.auditorias (id, user_empresa, tabla, accion, new_data, old_data, fecha_hora) 
SELECT id, user_empresa, tabla, accion, new_data, old_data, fecha_hora FROM sigretback.auditorias ;

