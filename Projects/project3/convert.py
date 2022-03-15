import json

# load data
data = json.load(open("/home/cs143/data/nobel-laureates.json", "r"))

# get the id, givenName, and familyName of the first laureate
laureate = data["laureates"][0]
f = open("laureates.del", "w")

for i in data["laureates"]:
    f.write(i['id'])
    f.write("\t")
    if "orgName" in i:
        f.write(i["orgName"]["en"])
        f.write("\t")
        f.write("\\N")
        f.write("\t")
        f.write("\\N")
        f.write("\t")
        if "founded" in i:
            f.write(i["founded"]["date"])
            f.write("\t")
            if "city" in i["founded"]["place"]:
                f.write(i["founded"]["place"]["city"]["en"])
                f.write("\t")
                f.write(i["founded"]["place"]["country"]["en"])
            else:
                f.write("\\N")
                f.write("\t")
                f.write("\\N")
        else:
            f.write("\\N")
        f.write("\n")

    else:
        f.write(i["givenName"]["en"])
        f.write("\t")
        if "familyName" in i:
            f.write(i["familyName"]["en"])
            f.write("\t")
        else: 
            f.write("\\N")
            f.write("\t")
        f.write(i["gender"])
        f.write("\t")
        if "birth" in i:
            f.write(i["birth"]["date"])
            f.write("\t")
        if "birth" in i:
            if "city" in i["birth"]["place"]:
                f.write(i["birth"]["place"]["city"]["en"])
                f.write("\t")
                f.write(i["birth"]["place"]["country"]["en"])
        f.write("\n")
f.close()

n = open("prize.del", "w")
af = open("affiliation.del", "w")
a2 = open("assoc.del","w")
assoc_dict = {}
counter = 0
for i in data["laureates"]:
    for j in i["nobelPrizes"]:
        if "affiliations" in j:
            for k in j["affiliations"]:
                affi = (k.get("name", {}).get("en","\\N"), k.get("city", {}).get("en","\\N"), k.get("country", {}).get("en","\\N"))
                if affi not in assoc_dict:
                    af.write('{}\t{}\t{}\t{}\n'.format(counter, affi[0], affi[1], affi[2]))
                    assoc_dict[affi] = counter
                    counter += 1 
                idx = assoc_dict[affi]
                a2.write('{}\t{}\t{}\t{}\t{}\t{}\t{}\n'.format(idx, i['id'], j["awardYear"], j["category"]["en"], k["name"]["en"], k.get("city", {}).get("en","\\N"), k.get("country", {}).get("en","\\N")))
        n.write(i['id'])
        n.write("\t")
        n.write(j["awardYear"])
        n.write("\t")
        n.write(j["category"]["en"])
        n.write("\t")
        n.write(j["sortOrder"])
        n.write("\n")
n.close()
af.close()
a2.close()
    

#this all depends on ED 