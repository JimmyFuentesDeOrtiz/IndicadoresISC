-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3308
-- Tiempo de generación: 07-09-2021 a las 03:19:37
-- Versión del servidor: 10.4.6-MariaDB
-- Versión de PHP: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `indicadores_isc`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_addAsignatura` (`clave` VARCHAR(10), `nom` VARCHAR(60), `eje` INT)  BEGIN
INSERT INTO `indicadores_isc`.`asignatura` (`AS_ClaveAsignatura`, `AS_NombreAsignatura`, `AS_Area`) 
VALUES (clave, nom, eje);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_addEje` (`nomb` VARCHAR(45))  BEGIN
set @idarea = (SELECT max(idareaConocimiento) FROM indicadores_isc.areaconocimiento);
INSERT INTO `indicadores_isc`.`areaconocimiento` (`idareaConocimiento`, `Nombre`) 
VALUES ((@idarea+1),nomb);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_addInfoEje` (`ejeP` INT, `periodoP` INT, `estEvalP` INT, `aprobadosP` INT)  BEGIN
INSERT INTO `indicadores_isc`.`infoeje` (`idinfoeje`, `periodo`, `estEval`, `aprobados`) 
VALUES (ejeP, periodoP, estEvalP, aprobadosP);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_addMatriInfo` (`matricula` INT, `matriculaEval` INT)  BEGIN
INSERT INTO `indicadores_isc`.`matriculainfo` (`matricula`, `matriculaEval`) 
VALUES (matricula, matriculaEval);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_addNivelDesempeño` (`claveP` VARCHAR(4), `semestreP` INT, `asignaturaP` VARCHAR(10), `docenteP` INT, `sumCalifP` INT, `totalEstEvalP` INT, `totalGroupP` INT, `aprobadosXParcialP` INT, `aprobadosU1P` INT, `aprobadosU2P` INT)  BEGIN
IF aprobadosU2P = -1 then
INSERT INTO `indicadores_isc`.`niveldesempeño`
(`claveGrupo`, `semestre`, `asignatura`, `docente`, `sumCalif`, `totalEstEval`,
`totalGroup`, `aprobadosXParcial`, `aprobadosU1`)
VALUES
(claveP, semestreP, asignaturaP, docenteP, sumCalifP, totalEstEvalP,
totalGroupP, aprobadosXParcialP, aprobadosU1P);
else
INSERT INTO `indicadores_isc`.`niveldesempeño`
(`claveGrupo`, `semestre`, `asignatura`, `docente`, `sumCalif`, `totalEstEval`,
`totalGroup`, `aprobadosXParcial`, `aprobadosU1`, `aprobadosU2`)
VALUES
(claveP, semestreP, asignaturaP, docenteP, sumCalifP, totalEstEvalP,
totalGroupP, aprobadosXParcialP, aprobadosU1P, aprobadosU2P);
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_addNivelFinal` (`grupoP` VARCHAR(5), `periodoFP` INT, `anioP` INT, `asigFP` VARCHAR(10), `sumCalifP` INT, `promP` DECIMAL(5,2), `totEstuP` INT, `aprobP` INT, `aprobTotal` INT, `matricula` INT)  BEGIN
if aprobTotal = -1 then
INSERT INTO `indicadores_isc`.`nivelfinal` (`grupo`, `periodoF`, `año`, `asigF`, `sumCalif`, `prom`, `totEstu`, `aprob`) 
VALUES (grupoP, periodoFP, anioP, asigFP, sumCalifP, promP, totEstuP, aprobP);
else
INSERT INTO `indicadores_isc`.`nivelfinal` (`grupo`, `periodoF`, `año`, `asigF`, `sumCalif`, `prom`, `totEstu`, `aprob`, `aprobTotal`, `matricula`) 
VALUES (grupoP, periodoFP, anioP, asigFP, sumCalifP, promP, totEstuP, aprobP, aprobTotal, matricula);
end if;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_addSemestre` (`periodoP` INT, `anioP` INT, `parcialP` INT, `matricP` INT, `aprobadosP` INT)  BEGIN
INSERT INTO `indicadores_isc`.`semestre` (`periodo`, `año`, `parcial`, `matric`, `aprobados`) 
VALUES (periodoP, anioP, parcialP, matricP, aprobadosP);

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_deleteAsignatura` (`clave` VARCHAR(10))  BEGIN
DELETE FROM `indicadores_isc`.`asignatura` 
WHERE (`AS_ClaveAsignatura` = clave);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_deleteEje` (`ideje` INT)  BEGIN
DELETE FROM `indicadores_isc`.`areaconocimiento` 
WHERE (`idareaConocimiento` = ideje);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_deleteGrupoParcial` (`claveGrupoP` VARCHAR(4), `semestreP` INT)  BEGIN
DELETE FROM `indicadores_isc`.`niveldesempeño` 
WHERE (`claveGrupo` = claveGrupoP) and (`semestre` = semestreP);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_deleteInfoEje` (`ejeP` INT, `periodoP` INT)  BEGIN
DELETE FROM `indicadores_isc`.`infoeje` 
WHERE (`idinfoeje` = ejeP) and (`periodo` = periodoP);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_deleteInfoFinal` (`grupo` VARCHAR(5), `periodoF` INT, `anio` INT)  BEGIN
DELETE FROM `indicadores_isc`.`nivelfinal` 
WHERE (`grupo` = grupo) and (`periodoF` = periodoF) and (`año` = anio);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_deleteMatriInfo` (`idMatri` INT)  BEGIN
DELETE FROM `indicadores_isc`.`matriculainfo` 
WHERE (`idMatriculaInfo` = idMatri);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_deleteNivelFinal` (`grupoP` VARCHAR(5), `periodoFP` INT, `anioP` INT)  BEGIN
DELETE FROM `indicadores_isc`.`nivelfinal` 
WHERE (`grupo` = grupoP) and (`periodoF` = periodoFP) and (`año` = anioP);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_deleteSemestre` (`idsemP` INT)  BEGIN
DELETE FROM `indicadores_isc`.`semestre` 
WHERE (`idsem` = idsemP);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_editAsignatura` (`clave` VARCHAR(10), `claveOri` VARCHAR(10), `nom` VARCHAR(60), `eje` INT)  BEGIN
UPDATE `indicadores_isc`.`asignatura` 
SET `AS_ClaveAsignatura` = clave, `AS_NombreAsignatura` = nom, `AS_Area` = eje 
WHERE (`AS_ClaveAsignatura` = claveOri);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_editEje` (`ideje` INT, `nomb` VARCHAR(45))  BEGIN
UPDATE `indicadores_isc`.`areaconocimiento` SET `Nombre` = nomb 
WHERE (`idareaConocimiento` = ideje);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_editInfoEje` (`ejeP` INT, `ejeO` INT, `periodoP` INT, `periodoO` INT, `estEvalP` INT, `aprobadosP` INT)  BEGIN
UPDATE `indicadores_isc`.`infoeje` 
SET `idinfoeje` = ejeP, `periodo` = periodoP, `estEval` = estEvalP, `aprobados` = aprobadosP 
WHERE (`idinfoeje` = ejeO) and (`periodo` = periodoO);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_editInfoFinal` (`grupo` VARCHAR(5), `periodoF` INT, `anio` INT, `aprobTotal` INT, `matricula` INT)  BEGIN
UPDATE `indicadores_isc`.`nivelfinal` SET `aprobTotal` = aprobTotal, `matricula` = matricula 
WHERE (`grupo` = grupo) and (`periodoF` = periodoF) and (`año` = anio);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_editMatriInfo` (`idmatri` INT, `matricula` INT, `matriculaEval` INT)  BEGIN
UPDATE `indicadores_isc`.`matriculainfo` 
SET `matricula` = matricula, `matriculaEval` = matriculaEval 
WHERE (`idMatriculaInfo` = idmatri);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_editNivelDesempeño` (`claveP` VARCHAR(4), `clavePO` VARCHAR(4), `semestreP` INT, `semestrePO` INT, `asignaturaP` VARCHAR(10), `docenteP` INT, `sumCalifP` INT, `totalEstEvalP` INT, `totalGroupP` INT, `aprobadosXParcialP` INT, `aprobadosU1P` INT, `aprobadosU2P` INT)  BEGIN
IF aprobadosU2P = -1 THEN
UPDATE `indicadores_isc`.`niveldesempeño` 
SET `aprobadosU2` = NULL WHERE (`claveGrupo` = clavePO) and (`semestre` = semestrePO);
UPDATE `indicadores_isc`.`niveldesempeño` 
SET `claveGrupo` = claveP, `semestre` = semestreP, `asignatura` = asignaturaP, `docente` = docenteP, 
`sumCalif` = sumCalifP, `totalEstEval` = totalEstEvalP, `totalGroup` = totalGroupP, `aprobadosXParcial` = aprobadosXParcialP, 
`aprobadosU1` = aprobadosU1P
WHERE (`claveGrupo` = clavePO) and (`semestre` = semestrePO);

else
UPDATE `indicadores_isc`.`niveldesempeño` 
SET `claveGrupo` = claveP, `semestre` = semestreP, `asignatura` = asignaturaP, `docente` = docenteP, 
`sumCalif` = sumCalifP, `totalEstEval` = totalEstEvalP, `totalGroup` = totalGroupP, `aprobadosXParcial` = aprobadosXParcialP, 
`aprobadosU1` = aprobadosU1P, `aprobadosU2` = aprobadosU2P 
WHERE (`claveGrupo` = clavePO) and (`semestre` = semestrePO);
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_editNivelFinal` (`grupoP` VARCHAR(5), `grupoOri` VARCHAR(5), `periodoFP` INT, `periodoFOri` INT, `anioP` INT, `anioOri` INT, `asigFP` VARCHAR(10), `sumCalifP` INT, `promP` DECIMAL(5,2), `totEstuP` INT, `aprobP` INT)  BEGIN
UPDATE `indicadores_isc`.`nivelfinal` 
SET `grupo` = grupoP, `periodoF` = periodoFP, `año` = anioP, `asigF` = asigFP, 
`sumCalif` = sumCalifP, `prom` = promP, `totEstu` = totEstuP, `aprob` = aprobP 
WHERE (`grupo` = grupoOri) and (`periodoF` = periodoFOri) and (`año` = anioOri);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_editSemestre` (`idsemP` INT, `periodoP` INT, `anioP` INT, `parcialP` INT, `matricP` INT, `aprobadosP` INT)  BEGIN
UPDATE `indicadores_isc`.`semestre` 
SET `periodo` = periodoP, `año` = anioP, `parcial` = parcialP, `matric` = matricP, `aprobados` = aprobadosP 
WHERE (`idsem` = idsemP);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_getAsignaturaAdmin` ()  BEGIN
SELECT a.AS_ClaveAsignatura, a.AS_NombreAsignatura, a.AS_Area, e.Nombre
FROM indicadores_isc.asignatura a join indicadores_isc.areaconocimiento e
on a.AS_Area = e.idareaConocimiento;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_getDocenteAdmin` ()  BEGIN
SELECT * FROM indicadores_isc.docente;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_getEjesAdmin` ()  BEGIN
SELECT * FROM indicadores_isc.areaconocimiento;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_getInfoAreas` (`periop` INT, `añop` INT, `parp` INT)  BEGIN
SELECT a.Nombre, i.estEval, i.aprobados, i.aprobados/i.estEval*100 porArob, i.estEval-i.aprobados reprobados, (i.estEval-i.aprobados)/i.estEval*100 porRerob
FROM indicadores_isc.infoeje i join indicadores_isc.semestre s join indicadores_isc.areaconocimiento a
on i.idinfoeje = a.idareaConocimiento and s.idsem = i.periodo
where s.periodo = periop and s.año = añop and s.parcial = parp;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_getInfoEjeAdmin` ()  BEGIN
SELECT a.Nombre, i.estEval, i.aprobados, i.idinfoeje, i.periodo, s.periodo periodoS, s.año, s.parcial
FROM indicadores_isc.infoeje i join indicadores_isc.semestre s join indicadores_isc.areaconocimiento a
on i.idinfoeje = a.idareaConocimiento and s.idsem = i.periodo;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_getInfoFinal` (`periop` INT, `añop` INT)  BEGIN
SELECT m.matricula, m.matriculaEval, f.aprobTotal, f.aprobTotal/m.matriculaEval*100 porcentajeAprob, 
m.matriculaEval-f.aprobTotal reprobados, (m.matriculaEval-f.aprobTotal)/m.matriculaEval*100 porcentajeReprob
FROM indicadores_isc.matriculainfo m join indicadores_isc.nivelfinal f
on m.idMatriculaInfo = f.matricula
where f.periodoF = periop and f.año = añop
limit 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_getInfoParcial` (`periop` INT, `añop` INT, `parp` INT)  BEGIN
SELECT m.matricula, m.matriculaEval, s.aprobados, s.aprobados/m.matriculaEval*100 porcentajeAprob, 
m.matriculaEval-s.aprobados reprobados, (m.matriculaEval-s.aprobados)/m.matriculaEval*100 porcentajeReprob
FROM indicadores_isc.matriculainfo m join indicadores_isc.semestre s
on m.idMatriculaInfo = s.matric
where s.periodo = periop and s.año = añop and s.parcial = parp;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_getListaFinalCambiar` (`año` INT, `periodoF` INT)  BEGIN
SELECT grupo FROM indicadores_isc.nivelfinal 
where año = año and periodoF = periodoF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_getListaPerFin` ()  BEGIN
SELECT f.periodoF, f.año, f.aprobTotal, f.matricula, m.matricula matriculaN, m.matriculaEval
FROM indicadores_isc.nivelfinal f join indicadores_isc.matriculainfo m
group by año, periodoF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_getMatriInfo` ()  BEGIN
SELECT * FROM indicadores_isc.matriculainfo;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_getMatriToNewFinal` (`per` INT, `anio` INT)  BEGIN
SELECT aprobTotal, matricula FROM indicadores_isc.nivelfinal 
where periodoF = per and año = anio limit 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_getNivelFinal` (`perio` INT, `año` INT)  BEGIN
SELECT f.grupo, a.AS_NombreAsignatura asig, e.Nombre eje, f.sumCalif, f.prom, f.totEstu, 
f.aprob, f.aprob/f.totEstu*100 porAp, f.totEstu-f.aprob reprob, (f.totEstu-f.aprob)/f.totEstu*100 porReprob 
 FROM indicadores_isc.nivelfinal f join indicadores_isc.asignatura a 
 join indicadores_isc.areaconocimiento e
 on f.asigF = a.AS_ClaveAsignatura and a.AS_Area = e.idareaConocimiento
  where f.periodoF = perio and f.año = año
  order by f.grupo;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_getNivelFinalAdmin` ()  BEGIN
SELECT f.grupo, a.AS_NombreAsignatura asig, f.sumCalif, f.prom, f.totEstu, f.aprob,
f.periodoF, f.año, f.asigF
 FROM indicadores_isc.nivelfinal f join indicadores_isc.asignatura a 
 on f.asigF = a.AS_ClaveAsignatura
  order by f.grupo;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_getNivelParcial` (`op` INT, `perio` INT, `año` INT, `par` INT)  BEGIN
if op = 1 then
SELECT n.claveGrupo, a.AS_NombreAsignatura asignatura, e.Nombre eje, CONCAT(d.Nombre, ' ', d.APaterno, ' ', d.AMaterno) docente, 
n.sumCalif, n.sumCalif/n.totalEstEval promedio ,n.totalEstEval, n.totalGroup, n.aprobadosXParcial,
 n.aprobadosXParcial/n.totalEstEval*100 porcentajeAprob, n.totalEstEval-n.aprobadosXParcial reprobadosXParcial,
100-(n.aprobadosXParcial/n.totalEstEval*100) porcentajeReprob, n.aprobadosU1,  n.totalGroup-n.aprobadosU1 reprobadosU1,  
 n.aprobadosU2, n.totalGroup-n.aprobadosU2 reprobadosU2
 FROM indicadores_isc.niveldesempeño n join indicadores_isc.asignatura a join indicadores_isc.docente d 
 join indicadores_isc.areaconocimiento e join indicadores_isc.semestre s
 on n.asignatura = a.AS_ClaveAsignatura and a.AS_Area = e.idareaConocimiento 
 and n.docente = d.iddocente and s.idsem = n.semestre
 where s.periodo = perio and s.año = año and s.parcial = par 
 order by n.claveGrupo;
 else
 SELECT n.claveGrupo, a.AS_NombreAsignatura asignatura, e.Nombre eje, CONCAT(d.Nombre, ' ', d.APaterno, ' ', d.AMaterno) docente, 
n.sumCalif, n.sumCalif/n.totalEstEval promedio ,n.totalEstEval, n.totalGroup, n.aprobadosXParcial,
 n.aprobadosXParcial/n.totalEstEval*100 porcentajeAprob, n.totalEstEval-n.aprobadosXParcial reprobadosXParcial,
100-(n.aprobadosXParcial/n.totalEstEval*100) porcentajeReprob, n.aprobadosU1,  n.totalGroup-n.aprobadosU1 reprobadosU1,  
 n.aprobadosU2, n.totalGroup-n.aprobadosU2 reprobadosU2
 FROM indicadores_isc.niveldesempeño n join indicadores_isc.asignatura a join indicadores_isc.docente d 
 join indicadores_isc.areaconocimiento e join indicadores_isc.semestre s
 on n.asignatura = a.AS_ClaveAsignatura and a.AS_Area = e.idareaConocimiento 
 and n.docente = d.iddocente and s.idsem = n.semestre
 where s.periodo = perio and s.año = año and s.parcial = par 
 order by e.idareaConocimiento, n.claveGrupo;
 end if;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_getNivelParcialAdmin` ()  BEGIN
SELECT n.claveGrupo, n.asignatura claveAsig, a.AS_NombreAsignatura asignatura, a.AS_Area, e.Nombre eje, n.docente, CONCAT(d.Nombre, ' ', d.APaterno, ' ', d.AMaterno) docenteN, 
n.sumCalif,n.totalEstEval, n.totalGroup, n.aprobadosXParcial, n.aprobadosU1, n.aprobadosU2, n.semestre, s.periodo, s.año, s.parcial
 FROM indicadores_isc.niveldesempeño n join indicadores_isc.asignatura a join indicadores_isc.docente d 
 join indicadores_isc.areaconocimiento e join indicadores_isc.semestre s
 on n.asignatura = a.AS_ClaveAsignatura and a.AS_Area = e.idareaConocimiento 
 and n.docente = d.iddocente and s.idsem = n.semestre
order by n.claveGrupo;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_getNumFinales` ()  BEGIN
SELECT periodoF, año 
FROM indicadores_isc.nivelfinal
group by periodoF, año order by año, periodoF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_getNumParcialSem` (`peri` INT, `anio` INT)  BEGIN
SELECT s.parcial 
FROM indicadores_isc.semestre s 
where s.periodo=peri and s.año =anio group by s.parcial;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_getPeriodo` ()  BEGIN
SELECT periodo, año, parcial, idsem FROM indicadores_isc.semestre
group by periodo, año order by año, periodo;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_getSemestreAdmin` ()  BEGIN
SELECT * FROM indicadores_isc.semestre;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_getUnPeriodo` (`pper` INT, `paño` INT)  BEGIN
SELECT s.periodo, s.año, s.parcial, s.idsem 
FROM indicadores_isc.semestre s where s.periodo = pper and s.año = paño
group by s.periodo, s.año, s.parcial
limit 1;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areaconocimiento`
--

CREATE TABLE `areaconocimiento` (
  `idareaConocimiento` int(11) NOT NULL,
  `Nombre` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `areaconocimiento`
--

INSERT INTO `areaconocimiento` (`idareaConocimiento`, `Nombre`) VALUES
(1, 'Ciencias Basicas'),
(2, 'Ciencias de la Ingenieria'),
(3, 'Ingenieria Aplicada y Diseño en Ingenieria'),
(4, 'Ciencias Sociales y Humanidades'),
(5, 'Ciencias economico administrativa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignatura`
--

CREATE TABLE `asignatura` (
  `AS_ClaveAsignatura` varchar(10) NOT NULL,
  `AS_NombreAsignatura` varchar(60) DEFAULT NULL,
  `AS_Area` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `asignatura`
--

INSERT INTO `asignatura` (`AS_ClaveAsignatura`, `AS_NombreAsignatura`, `AS_Area`) VALUES
('ACA-0907', 'Taller de Etica', 4),
('ACA-0909', 'Taller de Investigacion I', 3),
('ACA-0910', 'Taller de Investigacion II', 3),
('ACC-0906', 'Fundamentos de Investigacion', 4),
('ACD-0908', 'Desarollo Sustentable', 5),
('ACF-0901', 'Calculo Diferencial', 1),
('ACF-0902', 'Calculo Integral', 1),
('ACF-0903', 'Algebra Lineal', 1),
('ACF-0904', 'Calculo Vectorial', 1),
('ACF-0905', 'Ecuaciones Diferenciales', 1),
('AEB-1055', 'Programacion WEB', 3),
('AEC-1008', 'Contabilidad Financiera', 5),
('AEC-1034', 'Fundamentos de Telecomunicaciones', 2),
('AEC-1058', 'Quimica General', 1),
('AEC-1061', 'Sistemas Operativos', 2),
('AED-1026', 'Estructura de Datos', 2),
('AEF-1031', 'Fundamentos de Base de Datos', 3),
('AEF-1041', 'Matematicas Discretas', 1),
('AEF-1052', 'Probabilidad y Estadistica', 1),
('CDDT-2001', 'Introduccion a la Ciencia de los Datos', 3),
('CDDT-2002', 'Lenguajes de Programacion para Ciencia de los Datos', 3),
('CDDT-2003', 'Mineria de Datos', 3),
('CDDT-2004', 'Aprendizaje Maquina', 3),
('CDDT-2005', 'Inteligencia de Negocios', 3),
('SCA-1004', 'Administracion de Redes', 3),
('SCA-1025', 'Taller de Base de Datos', 3),
('SCA-1026', 'Taller de Sistemas Operativos', 3),
('SCB-1001', 'Administracion de Base de Datos', 3),
('SCC-1005', 'Cultura Empresarial', 5),
('SCC-1007', 'Fundamentos de Ing. de Software', 3),
('SCC-1010', 'Graficacion', 3),
('SCC-1012', 'Inteligencia Artificial', 3),
('SCC-1013', 'Investigacion de Operaciones', 1),
('SCC-1014', 'Lenguajes de Interfaz', 3),
('SCC-1017', 'Metodos Numericos', 2),
('SCC-1019', 'Programacion Logica y Funcional', 3),
('SCC-1023', 'Sistemas Programables', 3),
('SCD-1003', 'Arquitectura de Computadoras', 3),
('SCD-1004', 'Conmutacion y Enrutamiento de Redes de Datos', 3),
('SCD-1008', 'Fundamentos de Programacion', 2),
('SCD-1011', 'Ingenieria de Software', 3),
('SCD-1015', 'Lenguajes y Automatas I', 3),
('SCD-1016', 'Lenguajes y Automatas II', 3),
('SCD-1018', 'Principios Electricos y Aplicaciones Digitale', 2),
('SCD-1020', 'Programacion Orientada a Objetos', 2),
('SCD-1021', 'Redes de Computadoras', 3),
('SCD-1022', 'Simulacion', 3),
('SCD-1027', 'Topicos Avanzados de Programacion', 2),
('SCF-1006', 'Fisica General', 1),
('SCG-1009', 'Gestion de Proyectos de Software', 3),
('SCH-1024', 'Taller de Administracion', 5),
('TDAM-2001', 'Aplicaciones nativas para moviles de codigo abierto', 3),
('TDAM-2002', 'Programacion movil nativo para sistema propietario', 3),
('TDAM-2003', 'Visión por computadora en dispositivos moviles', 3),
('TDAM-2004', 'Lenguajes multiplataforma para el desarrollo movil', 3),
('TDAM-2005', 'Seguridad y testing en Tecnologia Movil', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docente`
--

CREATE TABLE `docente` (
  `iddocente` int(11) NOT NULL,
  `GradoAcademico` int(11) DEFAULT NULL,
  `Nombre` varchar(45) DEFAULT NULL,
  `APaterno` varchar(45) DEFAULT NULL,
  `AMaterno` varchar(45) DEFAULT NULL,
  `correo` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `docente`
--

INSERT INTO `docente` (`iddocente`, `GradoAcademico`, `Nombre`, `APaterno`, `AMaterno`, `correo`) VALUES
(1, 2, 'Javier', 'Pérez', 'Escamilla', 'javierperez@itsoeh.edu.mx'),
(2, 3, 'Lorena', 'Mendoza', 'Gúzman', 'lmendozag@itsoeh.edu.mx'),
(3, 3, 'Dulce Jazmín', 'Navarrete', 'Arias', 'dnavarrete@itsoeh.edu.mx'),
(4, 3, 'Mario', 'Pérez', 'Bautista', 'mperez@itsoeh.edu.mx'),
(5, 3, 'Cristy Elizabeth', 'Aguilar', 'Ojeda', 'caguilar@itsoeh.edu.mx'),
(6, 3, 'Héctor Daniel', 'Hernández', 'García', 'hhernandez@itsoeh.edu.mx'),
(7, 3, 'Eliud', 'Paredes', 'Reyes', 'eparedes@itsoeh.edu.mx'),
(8, 4, 'Elizabeth', 'García', 'Ríos', 'egarciar@itsoeh.edu.mx'),
(9, 3, 'Guadalupe', 'Calvo', 'Torres', 'gcalvo@itsoeh.edu.mx'),
(10, 3, 'Aline', 'Pérez', 'Martínez', 'aperez@itsoeh.edu.mx'),
(11, 3, 'Juan Carlos', 'Céron', 'Almaraz', 'jcerona@itsoeh.edu.mx'),
(12, 3, 'Sergio', 'Cruz', 'Pérez', 'scruzp@itsoeh.edu.mx'),
(13, 3, 'Guillermo', 'Castañeda', 'Ortíz', 'gcastaneda@itsoeh.edu.mx'),
(14, 2, 'Jorge Armando', 'Garcia', 'Bautista', 'jgarciab@itsoeh.edu.mx'),
(15, 3, 'Juan Lucino', 'Lugo', 'López', 'llugol@itsoeh.edu.mx'),
(16, 3, 'Juan Adolfo', 'Alvarez', 'Martínez', 'jaalvarez@itsoeh.edu.mx'),
(17, 1, 'German', 'Rebolledo', 'Avalos', 'grebolledo@itsoeh.edu.mx'),
(18, 2, 'Erik', 'Gomez', 'Hernandez', NULL),
(19, 2, 'Oscar', 'Jimenez', 'Aguilar', NULL),
(20, 2, 'Marlen', 'Vazquez', 'Mendoza', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `infoeje`
--

CREATE TABLE `infoeje` (
  `idinfoeje` int(11) NOT NULL,
  `periodo` int(11) NOT NULL,
  `estEval` int(11) DEFAULT NULL,
  `aprobados` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `infoeje`
--

INSERT INTO `infoeje` (`idinfoeje`, `periodo`, `estEval`, `aprobados`) VALUES
(1, 1, 131, 70),
(2, 1, 184, 112),
(3, 1, 149, 103),
(5, 1, 72, 70);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matriculainfo`
--

CREATE TABLE `matriculainfo` (
  `idMatriculaInfo` int(11) NOT NULL,
  `matricula` int(11) DEFAULT NULL,
  `matriculaEval` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `matriculainfo`
--

INSERT INTO `matriculainfo` (`idMatriculaInfo`, `matricula`, `matriculaEval`) VALUES
(1, 232, 226);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `niveldesempeño`
--

CREATE TABLE `niveldesempeño` (
  `claveGrupo` varchar(4) NOT NULL,
  `semestre` int(11) NOT NULL,
  `asignatura` varchar(10) DEFAULT NULL,
  `docente` int(11) DEFAULT NULL,
  `sumCalif` int(11) DEFAULT NULL,
  `totalEstEval` int(11) DEFAULT NULL,
  `totalGroup` int(11) DEFAULT NULL,
  `aprobadosXParcial` int(11) DEFAULT NULL,
  `aprobadosU1` int(11) DEFAULT NULL,
  `aprobadosU2` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `niveldesempeño`
--

INSERT INTO `niveldesempeño` (`claveGrupo`, `semestre`, `asignatura`, `docente`, `sumCalif`, `totalEstEval`, `totalGroup`, `aprobadosXParcial`, `aprobadosU1`, `aprobadosU2`) VALUES
('1O2A', 1, 'ACF-0902', 16, 1630, 25, 25, 19, 19, NULL),
('1O2B', 1, 'ACF-0902', 11, 1982, 23, 23, 19, 19, NULL),
('1O2C', 1, 'ACF-0902', 16, 1479, 20, 20, 16, 16, NULL),
('1O4A', 1, 'ACF-0905', 11, 1742, 23, 23, 14, 14, NULL),
('1O4B', 1, 'ACF-0905', 11, 1762, 29, 29, 10, 10, NULL),
('1O6A', 1, 'SCD-1015', 10, 1946, 30, 15, 16, 8, 8),
('1O6B', 1, 'SCD-1015', 4, 4890, 64, 32, 54, 28, 26),
('2O2A', 1, 'SCD-1020', 4, 2046, 27, 27, 20, 20, NULL),
('2O2B', 1, 'SCD-1020', 7, 1754, 21, 21, 20, 20, NULL),
('2O2C', 1, 'SCD-1020', 12, 1814, 23, 23, 19, 19, NULL),
('2O4A', 1, 'SCC-1017', 8, 3187, 46, 23, 26, 13, 13),
('2O4B', 1, 'SCC-1017', 8, 4762, 64, 32, 53, 26, 27),
('2O6A', 1, 'SCD-1021', 17, 1114, 14, 14, 12, 12, NULL),
('2O6B', 1, 'SCD-1021', 17, 2517, 30, 30, 28, 28, NULL),
('2O8A', 1, 'SCA-1004', 5, 704, 11, 11, 7, 7, NULL),
('2O8B', 1, 'SCA-1004', 5, 386, 7, 7, 3, 3, NULL),
('3O2A', 1, 'AEC-1008', 15, 2503, 27, 27, 27, 27, NULL),
('3O2B', 1, 'AEC-1008', 15, 1982, 22, 22, 20, 20, NULL),
('3O2C', 1, 'AEC-1008', 15, 2166, 23, 23, 23, 23, NULL),
('3O4A', 1, 'SCD-1027', 10, 1585, 24, 24, 13, 13, NULL),
('3O4B', 1, 'SCD-1027', 1, 2199, 31, 31, 26, 26, NULL),
('3O6A', 1, 'SCB-1001', 6, 1772, 25, 25, 20, 20, NULL),
('3O6B', 1, 'SCB-1001', 1, 1534, 22, 22, 18, 18, NULL),
('3O7A', 1, 'SCC-1019', 3, 2164, 29, 29, 14, 14, NULL),
('3O7B', 1, 'SCC-1019', 10, 955, 13, 13, 10, 10, NULL),
('3O8A', 1, 'ACA-0910', 3, 1439, 19, 19, 9, 9, NULL),
('3O8B', 1, 'ACA-0910', 4, 1399, 22, 22, 12, 12, NULL),
('4O2A', 1, 'AEC-1058', 20, 2182, 27, 27, 25, 25, NULL),
('4O2B', 1, 'AEC-1058', 18, 2045, 23, 23, 20, 20, NULL),
('4O2C', 1, 'AEC-1058', 20, 1979, 23, 23, 23, 23, NULL),
('4O4A', 1, 'AEF-1031', 6, 1429, 21, 21, 13, 13, NULL),
('4O4B', 1, 'AEF-1031', 6, 2497, 32, 32, 26, 26, NULL),
('4O6A', 1, 'SCC-1010', 12, 1189, 19, 19, 11, 11, NULL),
('4O6B', 1, 'SCC-1010', 13, 1842, 27, 27, 16, 16, NULL),
('5O2A', 1, 'ACF-0903', 13, 2133, 27, 27, 23, 23, NULL),
('5O2B', 1, 'ACF-0903', 9, 1473, 24, 24, 10, 10, NULL),
('5O2C', 1, 'ACF-0903', 17, 1981, 24, 24, 21, 21, NULL),
('5O4A', 1, 'SCA-1026', 2, 1857, 22, 22, 20, 20, NULL),
('5O4B', 1, 'SCA-1026', 2, 2724, 31, 31, 31, 31, NULL),
('5O6A', 1, 'SCD-1011', 5, 524, 7, 7, 6, 6, NULL),
('5O6B', 1, 'SCD-1011', 7, 2552, 27, 27, 26, 26, NULL),
('67CB', 1, 'CDDT-2003', 12, 1024, 18, 18, 8, 8, NULL),
('67DB', 1, 'CDDT-2004', 3, 1406, 18, 18, 11, 11, NULL),
('67EB', 1, 'CDDT-2005', 10, 1198, 17, 17, 10, 10, NULL),
('68CA', 1, 'TDAM-2003', 8, 1646, 19, 19, 17, 17, NULL),
('68DA', 1, 'TDAM-2004', 7, 1433, 19, 19, 15, 15, NULL),
('68EA', 1, 'TDAM-2005', 5, 1624, 19, 19, 18, 18, NULL),
('6O2A', 1, 'AEF-1052', 2, 2036, 27, 27, 21, 21, NULL),
('6O2B', 1, 'AEF-1052', 14, 1681, 23, 23, 19, 19, NULL),
('6O2C', 1, 'AEF-1052', 14, 1834, 23, 23, 19, 19, NULL),
('6O4A', 1, 'SCD-1018', 14, 1420, 21, 21, 16, 16, NULL),
('6O4B', 1, 'SCD-1018', 9, 2774, 32, 32, 30, 30, NULL),
('6O6A', 1, 'SCC-1014', 9, 1256, 14, 14, 13, 13, NULL),
('6O6B', 1, 'SCC-1014', 9, 2432, 28, 28, 25, 25, NULL),
('7O5R', 1, 'AEB-1055', 19, 360, 4, 2, 4, 2, 2),
('7O6A', 1, 'ACA-0909', 8, 1137, 15, 15, 12, 12, NULL),
('7O6B', 1, 'ACA-0909', 15, 2809, 30, 30, 30, 30, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nivelfinal`
--

CREATE TABLE `nivelfinal` (
  `grupo` varchar(5) NOT NULL,
  `periodoF` int(11) NOT NULL DEFAULT 1,
  `año` int(11) NOT NULL,
  `asigF` varchar(10) DEFAULT NULL,
  `sumCalif` int(11) DEFAULT NULL,
  `prom` decimal(5,2) DEFAULT NULL,
  `totEstu` int(11) DEFAULT NULL,
  `aprob` int(11) DEFAULT NULL,
  `aprobTotal` int(11) DEFAULT NULL,
  `matricula` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `nivelfinal`
--

INSERT INTO `nivelfinal` (`grupo`, `periodoF`, `año`, `asigF`, `sumCalif`, `prom`, `totEstu`, `aprob`, `aprobTotal`, `matricula`) VALUES
('1O2', 1, 2021, 'ACF-0902', 4253, '62.54', 68, 51, 153, 1),
('1O4', 1, 2021, 'ACF-0905', 2749, '52.87', 52, 36, 153, 1),
('1O6', 1, 2021, 'SCD-1015', 3312, '69.00', 48, 39, 153, 1),
('2O2', 1, 2021, 'SCD-1020', 4512, '63.55', 71, 53, 153, 1),
('2O4', 1, 2021, 'SCC-1017', 3812, '69.31', 55, 46, 153, 1),
('2O6', 1, 2021, 'SCD-1021', 3818, '86.77', 44, 44, 153, 1),
('2O8', 1, 2021, 'SCA-1004', 1311, '72.83', 18, 16, 153, 1),
('3O2', 1, 2021, 'AEC-1008', 5690, '79.03', 72, 65, 153, 1),
('3O4', 1, 2021, 'SCD-1027', 3607, '65.58', 55, 43, 153, 1),
('3O6', 1, 2021, 'SCB-1001', 3483, '74.11', 47, 40, 153, 1),
('3O7', 1, 2021, 'SCC-1019', 3120, '72.56', 43, 37, 153, 1),
('3O8', 1, 2021, 'ACA-0910', 2655, '64.76', 41, 32, 153, 1),
('4O2', 1, 2021, 'AEC-1058', 5671, '77.68', 73, 64, 153, 1),
('4O4', 1, 2021, 'AEF-1031', 3999, '75.45', 53, 46, 153, 1),
('4O6', 1, 2021, 'SCC-1010', 3396, '73.83', 46, 38, 153, 1),
('5O2', 1, 2021, 'ACF-0903', 4955, '66.07', 75, 58, 153, 1),
('5O4', 1, 2021, 'SCA-1026', 4507, '85.04', 53, 52, 153, 1),
('5O6', 1, 2021, 'SCD-1011', 2857, '84.03', 34, 32, 153, 1),
('67C', 1, 2021, 'CDDT-2003', 1501, '83.39', 18, 17, 153, 1),
('67D', 1, 2021, 'CDDT-2004', 1439, '79.94', 18, 17, 153, 1),
('67E', 1, 2021, 'CDDT-2005', 1429, '84.06', 17, 16, 153, 1),
('68C', 1, 2021, 'TDAM-2003', 1364, '71.79', 19, 15, 153, 1),
('68D', 1, 2021, 'TDAM-2004', 1288, '67.79', 19, 15, 153, 1),
('68E', 1, 2021, 'TDAM-2005', 1124, '59.16', 19, 13, 153, 1),
('6O2', 1, 2021, 'AEF-1052', 5001, '68.51', 73, 59, 153, 1),
('6O4', 1, 2021, 'SCD-1018', 4147, '78.25', 53, 48, 153, 1),
('6O6', 1, 2021, 'SCC-1014', 3388, '80.67', 42, 38, 153, 1),
('7O5', 1, 2021, 'AEB-1055', 164, '82.00', 2, 2, 153, 1),
('7O6', 1, 2021, 'ACA-0909', 3626, '80.58', 45, 42, 153, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `semestre`
--

CREATE TABLE `semestre` (
  `idsem` int(11) NOT NULL,
  `periodo` int(11) DEFAULT NULL,
  `año` int(11) DEFAULT NULL,
  `parcial` int(11) DEFAULT NULL,
  `matric` int(11) DEFAULT NULL,
  `aprobados` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `semestre`
--

INSERT INTO `semestre` (`idsem`, `periodo`, `año`, `parcial`, `matric`, `aprobados`) VALUES
(1, 1, 2021, 1, 1, 96);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `areaconocimiento`
--
ALTER TABLE `areaconocimiento`
  ADD PRIMARY KEY (`idareaConocimiento`);

--
-- Indices de la tabla `asignatura`
--
ALTER TABLE `asignatura`
  ADD PRIMARY KEY (`AS_ClaveAsignatura`),
  ADD KEY `AS_Area_idx` (`AS_Area`);

--
-- Indices de la tabla `docente`
--
ALTER TABLE `docente`
  ADD PRIMARY KEY (`iddocente`);

--
-- Indices de la tabla `infoeje`
--
ALTER TABLE `infoeje`
  ADD PRIMARY KEY (`idinfoeje`,`periodo`),
  ADD KEY `periodo_idx` (`periodo`);

--
-- Indices de la tabla `matriculainfo`
--
ALTER TABLE `matriculainfo`
  ADD PRIMARY KEY (`idMatriculaInfo`);

--
-- Indices de la tabla `niveldesempeño`
--
ALTER TABLE `niveldesempeño`
  ADD PRIMARY KEY (`claveGrupo`,`semestre`),
  ADD KEY `asignatura_idx` (`asignatura`),
  ADD KEY `docente_idx` (`docente`),
  ADD KEY `semestre_idx` (`semestre`);

--
-- Indices de la tabla `nivelfinal`
--
ALTER TABLE `nivelfinal`
  ADD PRIMARY KEY (`grupo`,`periodoF`,`año`),
  ADD KEY `asigF_idx` (`asigF`),
  ADD KEY `matricula_idx` (`matricula`);

--
-- Indices de la tabla `semestre`
--
ALTER TABLE `semestre`
  ADD PRIMARY KEY (`idsem`),
  ADD KEY `matric_idx` (`matric`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `docente`
--
ALTER TABLE `docente`
  MODIFY `iddocente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `matriculainfo`
--
ALTER TABLE `matriculainfo`
  MODIFY `idMatriculaInfo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `semestre`
--
ALTER TABLE `semestre`
  MODIFY `idsem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asignatura`
--
ALTER TABLE `asignatura`
  ADD CONSTRAINT `AS_Area` FOREIGN KEY (`AS_Area`) REFERENCES `areaconocimiento` (`idareaConocimiento`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `infoeje`
--
ALTER TABLE `infoeje`
  ADD CONSTRAINT `infeje` FOREIGN KEY (`idinfoeje`) REFERENCES `areaconocimiento` (`idareaConocimiento`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `periodo` FOREIGN KEY (`periodo`) REFERENCES `semestre` (`idsem`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `niveldesempeño`
--
ALTER TABLE `niveldesempeño`
  ADD CONSTRAINT `asignatura` FOREIGN KEY (`asignatura`) REFERENCES `asignatura` (`AS_ClaveAsignatura`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `docente` FOREIGN KEY (`docente`) REFERENCES `docente` (`iddocente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `semestre` FOREIGN KEY (`semestre`) REFERENCES `semestre` (`idsem`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `nivelfinal`
--
ALTER TABLE `nivelfinal`
  ADD CONSTRAINT `asigF` FOREIGN KEY (`asigF`) REFERENCES `asignatura` (`AS_ClaveAsignatura`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `matricula` FOREIGN KEY (`matricula`) REFERENCES `matriculainfo` (`idMatriculaInfo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `semestre`
--
ALTER TABLE `semestre`
  ADD CONSTRAINT `matric` FOREIGN KEY (`matric`) REFERENCES `matriculainfo` (`idMatriculaInfo`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
