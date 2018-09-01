import mysql.connector

cnx = mysql.connector.connect(user='johantibbelin_se_ppval', password='ppval2018',
                              host='johantibbelin.se.mysql',
                              database='johantibbelin.se_ppval')
cnx.close()
