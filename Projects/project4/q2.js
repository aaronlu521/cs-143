db.laureates.aggregate([
    {$unwind: '$nobelPrizes'},
    {$unwind: '$nobelPrizes.affiliations'},
    {$addFields: {"country": "$nobelPrizes.affiliations.country.en" }},
    {$match: {'nobelPrizes.affiliations.name.en': "CERN"}},
    {$limit: 1},
    {$project: {_id:0, 'country':1}}])