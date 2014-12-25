CREATE DEFINER=`root`@`localhost` PROCEDURE `listarMatriculaXCargaAcademic`(codigo int)
BEGIN
	select M.id, M.codAlumno as codigo, CONCAT(A.nombre,' ',A.apellidos) as alumno, M.codCargaAcademica_cl, F.nombre as curso
	from matricula_cl M
	inner join alumno A on M.codAlumno = A.id
	inner join carga_academica_cl C on M.codCargaAcademica_cl = C.codCargaAcademica_cl and M.codCargaAcademica_cl = codigo
	inner join curso_cl F on C.codCurso_cl = F.id
	order by id;
END