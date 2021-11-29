INSERT INTO c_estados(descripcion) VALUES("Activo");
INSERT INTO c_estados(descripcion) VALUES("Inactivo");
INSERT INTO c_estados(descripcion) VALUES("Borrado");


INSERT INTO c_justificacion_pausas(descripcion,estado_id) VALUES("Acero inducido",1);
INSERT INTO c_justificacion_pausas(descripcion,estado_id) VALUES("Actividad Programada/No autorizado hasta ventana de mtto",1);
INSERT INTO c_justificacion_pausas(descripcion,estado_id) VALUES("Asalto o Vandalismo",1);
INSERT INTO c_justificacion_pausas(descripcion,estado_id) VALUES("Autoridades de gobierno no permiten laborar",1);
INSERT INTO c_justificacion_pausas(descripcion,estado_id) VALUES("En espera de acceso a la OLT",1);
INSERT INTO c_justificacion_pausas(descripcion,estado_id) VALUES("En espera de apoyo para depuracion",1);
INSERT INTO c_justificacion_pausas(descripcion,estado_id) VALUES("En espera de datos de ctes",1);
INSERT INTO c_justificacion_pausas(descripcion,estado_id) VALUES("En espera de Ingenierias",1);
INSERT INTO c_justificacion_pausas(descripcion,estado_id) VALUES("En espera de Validacion por TPE/NOC",1);
INSERT INTO c_justificacion_pausas(descripcion,estado_id) VALUES("Imputable a instafibra",1);
INSERT INTO c_justificacion_pausas(descripcion,estado_id) VALUES("Ingenieria NO coincide",1);
INSERT INTO c_justificacion_pausas(descripcion,estado_id) VALUES("Lluvia/factor climatico",1);
INSERT INTO c_justificacion_pausas(descripcion,estado_id) VALUES("Mercado ambulante o calle cerrada",1);
INSERT INTO c_justificacion_pausas(descripcion,estado_id) VALUES("Permiso especial para trabajos en zona",1);
INSERT INTO c_justificacion_pausas(descripcion,estado_id) VALUES("Problemas con permisos (permisos  no validos)",1);
INSERT INTO c_justificacion_pausas(descripcion,estado_id) VALUES("Problemas de acceso por arrendatario",1);
INSERT INTO c_justificacion_pausas(descripcion,estado_id) VALUES("Problemas de acceso por infraestructura",1);
INSERT INTO c_justificacion_pausas(descripcion,estado_id) VALUES("Sin trayectorias",1);
INSERT INTO c_justificacion_pausas(descripcion,estado_id) VALUES("Trabajos de CFE (no permiten laborar)",1);
INSERT INTO c_justificacion_pausas(descripcion,estado_id) VALUES("Vecinos no permiten trabajar",1);
INSERT INTO c_justificacion_pausas(descripcion,estado_id) VALUES("Zona acordonada por protección civil",1);
INSERT INTO c_justificacion_pausas(descripcion,estado_id) VALUES("Zona de alto riesgo",1);
INSERT INTO c_justificacion_pausas(descripcion,estado_id) VALUES("Zona de dificil acceso",1);



INSERT INTO c_turnos(descripcion,estado_id) VALUES("Dia",1);
INSERT INTO c_turnos(descripcion,estado_id) VALUES("Noche",1);

INSERT INTO c_supervisors(Nombre,estado_id) VALUES('Paulo Lenin Puerta Mendoza',1);
INSERT INTO c_supervisors(Nombre,estado_id) VALUES('Carlos Franciscco Inda Alvarado',1);
INSERT INTO c_supervisors(Nombre,estado_id) VALUES('Nehisem Avilez',1);

INSERT INTO c_distritos(descripcion,supervisor_id,estado_id) VALUES("TX OTE II",1,1);
INSERT INTO c_distritos(descripcion,supervisor_id,estado_id) VALUES("TX Centro Sur",2,1);
INSERT INTO c_distritos(descripcion,supervisor_id,estado_id) VALUES("D6 Iztapalapa",2,1);
INSERT INTO c_distritos(descripcion,supervisor_id,estado_id) VALUES("D26 Constitucion",1,1);
INSERT INTO c_distritos(descripcion,supervisor_id,estado_id) VALUES("TX Cuernavaca",3,1);
INSERT INTO c_distritos(descripcion,supervisor_id,estado_id) VALUES("Cuernavaca 1",3,1);
INSERT INTO c_distritos(descripcion,supervisor_id,estado_id) VALUES("Cuernavaca 2",3,1);

INSERT INTO c_clusters(descripcion,distrito_id,estado_id) VALUES("TX",1,1);
INSERT INTO c_clusters(descripcion,distrito_id,estado_id) VALUES("TX",2,1);
INSERT INTO c_clusters(descripcion,distrito_id,estado_id) VALUES("Miramontes",3,1);
INSERT INTO c_clusters(descripcion,distrito_id,estado_id) VALUES("Granjas Esmeralda",3,1);
INSERT INTO c_clusters(descripcion,distrito_id,estado_id) VALUES("Culhuacan",3,1);
INSERT INTO c_clusters(descripcion,distrito_id,estado_id) VALUES("Cerro de la Estrella",3,1);
INSERT INTO c_clusters(descripcion,distrito_id,estado_id) VALUES("Ampliacion Cerro de la Estrella",3,1);
INSERT INTO c_clusters(descripcion,distrito_id,estado_id) VALUES("San Lorenzo Tezonco",3,1);
INSERT INTO c_clusters(descripcion,distrito_id,estado_id) VALUES("Santa Maria Acatitla",4,1);
INSERT INTO c_clusters(descripcion,distrito_id,estado_id) VALUES("Santa Martha Acatitla Sur",4,1);
INSERT INTO c_clusters(descripcion,distrito_id,estado_id) VALUES("Ixtlahuaca",4,1);
INSERT INTO c_clusters(descripcion,distrito_id,estado_id) VALUES("Palmitas",4,1);
INSERT INTO c_clusters(descripcion,distrito_id,estado_id) VALUES("Constitucion",4,1);
INSERT INTO c_clusters(descripcion,distrito_id,estado_id) VALUES("TX",5,1);
INSERT INTO c_clusters(descripcion,distrito_id,estado_id) VALUES("Cuernavaca 1",6,1);
INSERT INTO c_clusters(descripcion,distrito_id,estado_id) VALUES("Cuernavaca 2",6,1);
INSERT INTO c_clusters(descripcion,distrito_id,estado_id) VALUES("Cuernavaca 3",6,1);
INSERT INTO c_clusters(descripcion,distrito_id,estado_id) VALUES("Ampliacion Cuernavaca 2",6,1);
INSERT INTO c_clusters(descripcion,distrito_id,estado_id) VALUES("Ocotepec",6,1);
INSERT INTO c_clusters(descripcion,distrito_id,estado_id) VALUES("Ampliacion Ocotepec",6,1);
INSERT INTO c_clusters(descripcion,distrito_id,estado_id) VALUES("Tejalpa",6,1);
INSERT INTO c_clusters(descripcion,distrito_id,estado_id) VALUES("Ampliacion Tejalpa",6,1);
INSERT INTO c_clusters(descripcion,distrito_id,estado_id) VALUES("Temixco",7,1);
INSERT INTO c_clusters(descripcion,distrito_id,estado_id) VALUES("Xochitepec",7,1);
INSERT INTO c_clusters(descripcion,distrito_id,estado_id) VALUES("Jiutepec",7,1);
INSERT INTO c_clusters(descripcion,distrito_id,estado_id) VALUES("San Jose Cumbres",7,1);

INSERT INTO c_fallas(descripcion,estado_id) VALUES('Por definir',1);
INSERT INTO c_fallas(descripcion,estado_id) VALUES('Mantenimiento',1);
INSERT INTO c_fallas(descripcion,estado_id) VALUES('Corte F.O.',1);
INSERT INTO c_fallas(descripcion,estado_id) VALUES('Reforzamiento',1);
INSERT INTO c_fallas(descripcion,estado_id) VALUES('Splitter atenuado',1);
INSERT INTO c_fallas(descripcion,estado_id) VALUES('Implementacion 2N',1);

INSERT INTO c_causas (descripcion,estado_id) VALUES('Sin Causa',1)
INSERT INTO c_causas(descripcion,estado_id) VALUES('Accidente vehicular',1);
INSERT INTO c_causas(descripcion,estado_id) VALUES('Acometida rota',1);
INSERT INTO c_causas(descripcion,estado_id) VALUES('Acopladores sucios',1);
INSERT INTO c_causas(descripcion,estado_id) VALUES('Bote en mal estado',1);
INSERT INTO c_causas(descripcion,estado_id) VALUES('Clean up',1);
INSERT INTO c_causas(descripcion,estado_id) VALUES('Daño interno de F.O.',1);
INSERT INTO c_causas(descripcion,estado_id) VALUES('Desagregacion',1);
INSERT INTO c_causas(descripcion,estado_id) VALUES('Empalme desgradado',1);
INSERT INTO c_causas(descripcion,estado_id) VALUES('Factor climatico',1);
INSERT INTO c_causas(descripcion,estado_id) VALUES('Falla en jumper',1);
INSERT INTO c_causas(descripcion,estado_id) VALUES('Falla hardware',1);
INSERT INTO c_causas(descripcion,estado_id) VALUES('F.O. suelta u holgada',1);
INSERT INTO c_causas(descripcion,estado_id) VALUES('Folio duplicado',1);
INSERT INTO c_causas(descripcion,estado_id) VALUES('Folio mal asignado',1);
INSERT INTO c_causas(descripcion,estado_id) VALUES('Implementacion 1N.',1);
INSERT INTO c_causas(descripcion,estado_id) VALUES('Implementacion 2N',1);
INSERT INTO c_causas(descripcion,estado_id) VALUES('Incendio',1);
INSERT INTO c_causas(descripcion,estado_id) VALUES('Induccion electrica',1);
INSERT INTO c_causas(descripcion,estado_id) VALUES('Intermitencia',1);
INSERT INTO c_causas(descripcion,estado_id) VALUES('Mala Construccion',1);
INSERT INTO c_causas(descripcion,estado_id) VALUES('Mala manipulacion',1);
INSERT INTO c_causas(descripcion,estado_id) VALUES('Mordedura de roedor(Nido de ave/Nido de Hormigas',1);
INSERT INTO c_causas(descripcion,estado_id) VALUES('Mantenimiento correctivo PI',1);
INSERT INTO c_causas(descripcion,estado_id) VALUES('No determinada por personal',1);
INSERT INTO c_causas(descripcion,estado_id) VALUES('Obra publica',1);
INSERT INTO c_causas(descripcion,estado_id) VALUES('Poda de arboles',1);
INSERT INTO c_causas(descripcion,estado_id) VALUES('Saturacion',1);
INSERT INTO c_causas(descripcion,estado_id) VALUES('Sin daño',1);
INSERT INTO c_causas(descripcion,estado_id) VALUES('Splitter dañado',1);
INSERT INTO c_causas(descripcion,estado_id) VALUES('Sustitucion de splitter',1);
INSERT INTO c_causas(descripcion,estado_id) VALUES('Trabajos de CFE/Cambio de posteria',1);
INSERT INTO c_causas(descripcion,estado_id) VALUES('Trabajos de otros carriers',1);
INSERT INTO c_causas(descripcion,estado_id) VALUES('Vandalismo',1);
INSERT INTO c_causas(descripcion,estado_id) VALUES('Vehiculo con exceso de dimensiones',1);


INSERT INTO c_tipo_folios(descripcion,time_max,campo_1,estado_id) VALUES('SD',6,1,1);
INSERT INTO c_tipo_folios(descripcion,time_max,campo_1,estado_id) VALUES('OT',6,2,1);
INSERT INTO c_tipo_folios(descripcion,time_max,campo_1,estado_id) VALUES('RFC',12,2,1);
INSERT INTO c_tipo_folios(descripcion,time_max,campo_1,estado_id) VALUES('PRJ',12,2,1);
INSERT INTO c_tipo_folios(descripcion,time_max,campo_1,estado_id) VALUES('OS',12,2,1);
INSERT INTO c_tipo_folios(descripcion,time_max,campo_1,estado_id) VALUES('Otro',12,3,1);


INSERT INTO c_despachos(Nombre,estado_id) VALUES('FRANCO SOSA ABEL',1);
INSERT INTO c_despachos(Nombre,estado_id) VALUES('MARTINEZ SOSA ELIZABETH KIREINA',1);
INSERT INTO c_despachos(Nombre,estado_id) VALUES('AGUILERA SOTO ALFREDO',1);
INSERT INTO c_despachos(Nombre,estado_id) VALUES('RECILLAS MORENO CLAUDIA STEPHANY',1);
INSERT INTO c_despachos(Nombre,estado_id) VALUES('GONZALEZ ANGUIANO LEI CARRIE',1);

INSERT INTO c_tecnicos(Nombre,estado_id) VALUES('Daniel Gonzalez',1);
INSERT INTO c_tecnicos(Nombre,estado_id) VALUES('Issac Velazquez',1);
INSERT INTO c_tecnicos(Nombre,estado_id) VALUES('Abraham Alpizar',1);
INSERT INTO c_tecnicos(Nombre,estado_id) VALUES('Jose Luis Peralta',1);
INSERT INTO c_tecnicos(Nombre,estado_id) VALUES('Alfonso Brito',1);
INSERT INTO c_tecnicos(Nombre,estado_id) VALUES('Victor Manuel Lopez Perez',1);
INSERT INTO c_tecnicos(Nombre,estado_id) VALUES('Cristian Elihu Chavez Salinas',1);
INSERT INTO c_tecnicos(Nombre,estado_id) VALUES('Aureliano Rojas Hernandez',1);
INSERT INTO c_tecnicos(Nombre,estado_id) VALUES('Gabriel Alberto Briones Zepeda',1);
INSERT INTO c_tecnicos(Nombre,estado_id) VALUES('Miguel Aguilar',1);
INSERT INTO c_tecnicos(Nombre,estado_id) VALUES('Daniel Aguilar',1);
INSERT INTO c_tecnicos(Nombre,estado_id) VALUES('Jose Gabriel',1);
INSERT INTO c_tecnicos(Nombre,estado_id) VALUES('Tomas Ramirez',1);
INSERT INTO c_tecnicos(Nombre,estado_id) VALUES('Leonel Jony',1);
INSERT INTO c_tecnicos(Nombre,estado_id) VALUES('Armando Lara',1);
INSERT INTO c_tecnicos(Nombre,estado_id) VALUES('Antonio Castañeda',1);

INSERT INTO c_materiales(descripcion,unidad_id,estado_id) VALUES('Clavos',1,1);
INSERT INTO c_materiales(descripcion,unidad_id,estado_id) VALUES('Tornillos',1,1);



