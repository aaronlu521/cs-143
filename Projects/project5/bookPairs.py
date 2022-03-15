from pyspark import SparkContext
sc = SparkContext("local", "bookPairs")
import itertools
lines = sc.textFile("/home/cs143/data/goodreads.user.books")
def line_split(line):
    results = line.split(":")[1]
    num = results.split(",")
    sets = list(itertools.combinations(num, 2))
    return sets
    

words = lines.flatMap(line_split)
word1s = words.map(lambda word: (word, 1))
wordCounts = word1s.reduceByKey(lambda a, b: a + b)
gt20 = wordCounts.filter(lambda t:t[1] > 20)  
gt20.saveAsTextFile("./output")