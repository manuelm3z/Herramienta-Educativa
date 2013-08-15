<?php
//contiene las configuraciones del sitio

// servidor de la base de datos
define("server", "localhost");
// usuario de la base de datos
define("user", "root");
// password de la base de datos
define("pass", "naci21-09");
// base de dato donde se obtendran los valores
define("bd", "codearagua");

//Arreglo con los nombres de las tablas creadas en base de datos.
$tablas = array('datos' => $datos,
	'evaluacion' => $evaluacion,
	'modulo' => $modulo,
	'notas' => $notas,
	'respuesta' => $respuesta,
	'usuario' => $usuario
	);

/**************************************
/Estas es la descripción de las tablas/
**************************************/
//Tabla que almacena datos de los usuarios
$datos = "CREATE TABLE  `soft_educ`.`datos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(50) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `nac` varchar(2) DEFAULT NULL,
  `cedula` int(11) NOT NULL,
  `direccion` longtext,
  `tel` varchar(40) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `fec_nac` date DEFAULT NULL,
  `sex` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;";

//tabla que almacena los datos de las evaluaciones
$evaluaciones = "CREATE TABLE  `soft_educ`.`evaluacion` (
  `idEvaluacion` int(11) NOT NULL AUTO_INCREMENT,
  `enunciado` text NOT NULL,
  `idModulo` int(11) NOT NULL,
  PRIMARY KEY (`idEvaluacion`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;";

//tabla que almacena los datos de los modulos
$modulo = "CREATE TABLE  `soft_educ`.`modulo` (
  `idModulo` int(11) NOT NULL AUTO_INCREMENT,
  `numeroModulo` varchar(4) NOT NULL,
  `nombreModulo` varchar(255) NOT NULL,
  `contenidoModulo` longtext NOT NULL,
  `imagen` longblob NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `fecha` date NOT NULL,
  `ultimaModificacion` date NOT NULL,
  PRIMARY KEY (`idModulo`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;";

//tabla que guarda las notas
$notas = "CREATE TABLE  `soft_educ`.`notas` (
  `idNota` int(11) NOT NULL AUTO_INCREMENT,
  `nota` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `status` varchar(8) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `idRespuesta` int(11) NOT NULL,
  `idEvaluacion` int(11) NOT NULL,
  PRIMARY KEY (`idNota`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;";

//tabla que guarda las respuestas
$respuesta = "CREATE TABLE  `soft_educ`.`respuesta` (
  `idRespuesta` int(11) NOT NULL AUTO_INCREMENT,
  `respuesta` text NOT NULL,
  `valor` int(11) NOT NULL,
  `idEvaluacion` int(11) NOT NULL,
  PRIMARY KEY (`idRespuesta`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;";

//tabla que guarda los usuarios
$usuario = "CREATE TABLE  `soft_educ`.`usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `fecha` date NOT NULL,
  `cedula` int(11) NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;";
?>