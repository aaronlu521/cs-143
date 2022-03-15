#Assume that if any 1-gram contains the character _, it is suffixed with a POS tag. 
#Remove all 1-grams that have a POS suffix. Then for each remaining 1-gram, 
#sum up its match count since 2000 (inclusive), and return the “1-gram TAB total-match-count” pair
#for top-10 most frequent 1-grams.

zcat /home/cs143/data/googlebooks-eng-all-1gram-20120701-s.gz | grep -v "_" | awk '$2 >= 2000' | datamash --full groupby 1 sum 3 | sort -k 5,5rn | cut -f 1,5 | head -10