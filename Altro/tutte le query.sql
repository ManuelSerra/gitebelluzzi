-- Query per vedere a quali classi è stato assegnato un professore
 SELECT FK_classe FROM docente INNER JOIN classiDocente ON docente.PK_codice = classiDocente.FK_docente WHERE docente.nome = 'Patrizia' 

-- Query nella quale vengono visualizzate tutte le classi che non sono inserite all'interno della tabella GiteScolastiche
SELECT classe.PK_codice FROM classe left join gitaScolastica on classe.PK_codice = gitaScolastica.FK_classe where gitaScolastica.FK_classe IS NULL 

--Query che ritorna il periodo (dal - al) di gita di ogni classe 
SELECT DATE_FORMAT(dataInizio, "%d/%m/%Y") as dataInizio, DATE_FORMAT(dataFine, "%d/%m/%Y") as dataFine FROM `gitaScolastica` 

--Query per visualizzare la classe per la quale si sta preparando il modulo,il totale degli alunni della classe e il numero degli studenti dal massimo degli alunni in classe al 75% dei componenti
Select DISTINCT classiDocente.FK_classe, classe.FK_docente , classe.alunniGita from classiDocente inner join classe on classe.PK_codice = classiDocente.FK_classe inner join studente on studente.FK_classe = classe.PK_codice where classiDocente.FK_docente = 'codice1'  and  classiDocente.FK_classe = '5bi'

--Menu a tendina da 0 a max disabili (prendere il dato dal db dei disabili)
select count(*) as disabili from classiDocente inner join classe on classe.PK_codice = classiDocente.FK_classe inner join studente on studente.FK_classe = classe.PK_codice where classiDocente.FK_docente = 'codice1' and disabile = 1 

--Menu a tendina da 0 a max stranieri (prendere il dato dal db degli stranieri)
select count(*) as extracomunitario from classiDocente inner join classe on classe.PK_codice = classiDocente.FK_classe inner join studente on studente.FK_classe = classe.PK_codice where classiDocente.FK_docente = 'codice1' and extracomunitario = 1

-- valori dell' "isConfermata" mostrati come "in attesa", "confermata" ,"rifiutata" ( 0, 1, 2)
SELECT FK_classe, CASE  isConfermata WHEN 1 THEN "confermata" WHEN 0 THEN "in attesa" WHEN 2 THEN "rifiutata" END AS "isConfermata" FROM gitaScolastica WHERE FK_docente = "codice2";

-- Valori dell' "ISCONFERMATA" con classe coordinatore 

SELECT classe.PK_codice,CASE gitaScolastica.isConfermata WHEN 0 THEN 'in attesa'  WHEN 1 THEN 'confermata' WHEN 2 THEN 'rifiutata' END AS 'isConfermata' from classe INNER JOIN gitaScolastica ON classe.PK_codice = gitaScolastica.FK_classe WHERE classe.FK_docente = gitaScolastica.FK_docente

