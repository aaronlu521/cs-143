#For every 1-gram, sum up its match counts over all years. Return “1-gram TAB total-match-count” for
# each 1-gram whose total match count is 1,000,000 or more.

zcat /home/cs143/data/googlebooks-eng-all-1gram-20120701-s.gz | datamash groupby 1 sum 3 | awk '$2 >= 1000000'