// How many different locations do the affiliation “University of California” have?
// Assume that a location is uniquely identified by its city and country. 
// Answer: { "locations" : 6 }
db.laureates.aggregate([
    {$unwind: '$nobelPrizes'},
    {$unwind: '$nobelPrizes.affiliations'},
    {$match: {'nobelPrizes.affiliations.name.en': "University of California"}},
    {$group: {_id:'$nobelPrizes.affiliations.city.en', distinctCities: {$addToSet: '$city.en'}}},
    {$count: "locations"}
])