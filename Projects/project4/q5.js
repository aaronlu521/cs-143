// In how many years a Nobel prize was awarded to an organization 
// (as opposed to a person) in at least one category?
// Answer: { "years" : 26 }
db.laureates.aggregate([{$addFields: {"orgName": "$orgName.en" }},
   {$group: {_id: {orgName: "$orgName"}, count: {$sum: 1},distinctCities: {$addToSet: '$orgName.en'}}}, 
    {$count: "years"}
     ])
