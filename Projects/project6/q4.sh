#For every year since 1900 (inclusive), find the most frequent 1-gram in the year 
#(in terms of its match count) and return “most-frequent-gram TAB year TAB gram’s-match-count” triple per each year.

zcat /home/cs143/data/googlebooks-eng-all-1gram-20120701-s.gz | awk '$2 >= 1900' | datamash --sort --full groupby 2 max 3 | cut -f 1,2,3