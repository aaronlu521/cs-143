#Find the 1-gram and the year in which the 1-gram’s match count in that year is at least 1,000 times as large as its 
#volume count. For each of such (1-gram, year) pairs, print “1-gram TAB year”.

#Note: The field separator in the Google N-gram data is the TAB character. 
#Fortunately, in all Unix commands that we learned in Part A, the TAB character works well as a 
#field separator by default. Therefore, you do not need to explicitly specify the field separator. 
#For this reason, the TAB character is the most frequently used field-separator in Unix.

zcat /home/cs143/data/googlebooks-eng-all-1gram-20120701-s.gz | awk '$3 >= ($4*1000)' | cut -f 1,2