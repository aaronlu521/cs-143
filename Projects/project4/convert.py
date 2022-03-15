import json

# load data
data = json.load(open("/home/cs143/data/nobel-laureates.json", "r"))

# get the id, givenName, and familyName of the first laureate
laureate = data["laureates"][0]
f = open("laureates.import", "w")

for i in data["laureates"]:
    data_str = json.dumps(i)
    f.write("\n")
    f.write(data_str)

f.close()
    

#this all depends on ED 
