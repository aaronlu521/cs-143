db.laureates.aggregate([{$addFields: {"familyName": "$familyName.en" }},
   {$group: {_id: "$familyName", count: {$sum: 1}}},
   {$match: {_id:{ $ne: null}}}, 
   {$match: {count: {"$gte": 5}}}, 
   {$project: {_id:0, familyName:"$_id"}}
   ])
