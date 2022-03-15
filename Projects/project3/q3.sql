SELECT familyName
FROM Laureates
WHERE familyName is not NULL
GROUP BY familyName
HAVING COUNT(*) >= 5;