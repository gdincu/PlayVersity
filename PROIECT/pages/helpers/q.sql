BEGIN

IF UPPER(a) = 'ARTIST' THEN
        SELECT e.name artist,a.name,a.length 
FROM song a
INNER JOIN songartist d ON a.id = d.idsong
INNER JOIN artist e ON d.idartist = e.id
ORDER BY e.name ASC;
END IF;

IF UPPER(a) = 'NAME' THEN
        SELECT e.name artist,a.name,a.length 
FROM song a
INNER JOIN songartist d ON a.id = d.idsong
INNER JOIN artist e ON d.idartist = e.id
ORDER BY a.name ASC;
    END IF;

END