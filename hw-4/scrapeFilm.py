import sqlite3
import urllib.request
from bs4 import BeautifulSoup
import re

def scrapePage(pageAddress):
	filmInfo = dict()
	try:
		req = urllib.request.Request(pageAddress, headers={'User-Agent': 'Mozilla/5.0'})
		page = urllib.request.urlopen(req)
		soup = BeautifulSoup(page, 'html.parser')


		filmInfo["naslov"] = 'a'
		filmInfo["opis"] = soup.find(class_='plot_summary_wrapper').find('div').find('div').string.strip()
		filmInfo["zanr"] = soup.find(class_='subtext').find('a').string
		filmInfo["scenarista"] = soup.find_all(class_='credit_summary_item')[1].find('a').string
		filmInfo["reziser"] = soup.find(class_='credit_summary_item').find('a').string
		filmInfo["producentska_kuca"] = 'Warner Bros.'
		filmInfo["godina_izdanja"] = soup.find(class_='title_wrapper').find('span').find('a').string
		filmInfo["trajanje"] =soup.find(class_='subtext').find('time').string.strip()
		filmInfo["pic"] = soup.find(class_='poster').find('img')['src']

	except Exception as e:
		print(e)

	return filmInfo

def scrapeList(pageAddress):
	filmList = list()
	try:
		req = urllib.request.Request(pageAddress, headers={'User-Agent': 'Mozilla/5.0'})
		page = urllib.request.urlopen(req)
		soup = BeautifulSoup(page, 'html.parser')

		titleTds = soup.find_all(class_="titleColumn")
		for td in titleTds:
			filmList.append('https://www.imdb.com' + re.search(r'/title/.*/',td.find('a')["href"]).group())

	except Exception as e:
		print(e)

	return filmList

def main():
	base = "https://www.filmfreak.tv/watch/"
	try:
		conn = sqlite3.connect("databases/film.db")
		c = conn.cursor()
		c.execute('''DROP TABLE if exists film''')
		c.execute('''CREATE TABLE film (
			naslov text, 
			opis text, 
			zanr text,
			scenarista text,
			reziser text,
			producentska_kuca text,
			godina_izdanja int,
			trajanje text,
			thumbnail text,
			filmid integer PRIMARY KEY
			)
			''')

		for i in range(20):
			c.execute("INSERT INTO film(naslov,opis,zanr,scenarista,reziser,producentska_kuca,godina_izdanja,trajanje,thumbnail)\
				VALUES (?,?,?,?,?,?,?,?,?)", 
				('The Dark Knight',
				'opiss ide ovdeeeeee opiss ide ovdeeeeee opiss ide ovdeeeeeeopiss ide ovdeeeeee opiss ide ovdeeeeee opiss ide ovdeeeeee opiss ide ovdeeeeee',
				'action',
				'j nolan',
				'c nolan',
				'wbros',
				'2008',
				'2h 32m',
				'https://m.media-amazon.com/images/M/MV5BMTMxNTMwODM0NF5BMl5BanBnXkFtZTcwODAyMTk2Mw@@._V1_UX182_CR0,0,182,268_AL_.jpg'))

		conn.commit()

		conn.close()
	except Exception as e:
		print(e)

def main2():
	conn = sqlite3.connect("databases/film.db")
	c = conn.cursor()
	linksPage = 'https://www.imdb.com/chart/top/?ref_=nv_mv_250'
	links=scrapeList(linksPage)

	for linkAddress in links:
		try:
			filmInfo = scrapePage(linkAddress)

			c.execute("INSERT INTO film(naslov,opis,zanr,scenarista,reziser,producentska_kuca,godina_izdanja,trajanje,thumbnail)\
				VALUES (?,?,?,?,?,?,?,?,?)", 
				(filmInfo['naslov'],
				filmInfo['opis'],
				filmInfo['zanr'],
				filmInfo['scenarista'],
				filmInfo['reziser'],
				filmInfo['producentska_kuca'],
				filmInfo['godina_izdanja'],
				filmInfo['trajanje'],
				filmInfo['pic']))

			print("INSERT INTO film(naslov,opis,zanr,scenarista,reziser,producentska_kuca,godina_izdanja,trajanje,thumbnail)\
				VALUES ({},{},{},{},{},{},{},{},{})".format
				(filmInfo['naslov'],
				filmInfo['opis'],
				filmInfo['zanr'],
				filmInfo['scenarista'],
				filmInfo['reziser'],
				filmInfo['producentska_kuca'],
				filmInfo['godina_izdanja'],
				filmInfo['trajanje'],
				filmInfo['pic']))

		except:
			pass

def mainT():
	conn = sqlite3.connect("databases/film.db")
	c = conn.cursor()

	
	c.execute()
		

def main3():
		conn = sqlite3.connect("databases/film.db")
		c = conn.cursor()
		c.execute('''DROP TABLE if exists korisnici''')
		c.execute('''CREATE TABLE korisnici (
			first_name text, 
			last_name text, 
			email text PRIMARY KEY,
			password text,
			username text,
			admin_status boolean
			)
			''')


		c.execute("INSERT INTO korisnici VALUES (?,?,?,?,?,?)", 
			('Mladen',
			'Ravlic',
			'something@something.gmail.com',
			'f1d5f55b43239f55a217c93f49340f71bb8a0c33c7bf220b50f81ebd80229d58',
			'Mladmin',
			True))



		conn.commit()

		conn.close()

def mainId():
	try:
		conn = sqlite3.connect("databases/film.db")
		c = conn.cursor()
		c.execute("PRAGMA foreign_keys = ON;")
		c.execute('''DROP TABLE if exists glumci''')
		c.execute('''CREATE TABLE glumci (
			film_id INTEGER,
			actor TEXT,
		    FOREIGN KEY (film_id) 
		    REFERENCES film (filmid) 
		    ON DELETE CASCADE
			)
			''')


		c.execute("INSERT INTO glumci VALUES (?,?)", 
			(1,
			'Christian Bale'))

		c.execute("INSERT INTO glumci VALUES (?,?)", 
			(1,
			'Heath Ledger'))



		conn.commit()

		conn.close()
	except Exception as e:
		print(e)

def mainInsert():
	try:
		conn = sqlite3.connect("databases/film.db")
		c = conn.cursor()
		c.execute("PRAGMA foreign_keys = ON;")



		c.execute("INSERT INTO glumci VALUES (?,?)", 
			(4,
			'Tom Hanks'))



		conn.commit()

		conn.close()
	except Exception as e:
		print(e)

def mainRatings():
	try:
		conn = sqlite3.connect("databases/film.db")
		c = conn.cursor()
		c.execute("PRAGMA foreign_keys = ON;")
		c.execute('''DROP TABLE if exists ocene''')
		c.execute('''CREATE TABLE ocene (
			film_id INTEGER,
			user_email TEXT,
			rating INTEGER,
		    FOREIGN KEY (film_id) 
		    REFERENCES film (filmid) 
		    ON DELETE CASCADE,
		    FOREIGN KEY (user_email) 
		    REFERENCES korisnici (email) 
		    ON DELETE CASCADE
			)
			''')



		conn.commit()

		conn.close()
	except Exception as e:
		print(e)

def main20():
	base = "https://www.filmfreak.tv/watch/"
	try:
		conn = sqlite3.connect("databases/film.db")
		c = conn.cursor()

		for i in range(20):
			c.execute("INSERT INTO film(naslov,opis,zanr,scenarista,reziser,producentska_kuca,godina_izdanja,trajanje,thumbnail)\
				VALUES (?,?,?,?,?,?,?,?,?)", 
				('The Dark Knight',
				'opiss ide ovdeeeeee opiss ide ovdeeeeee opiss ide ovdeeeeeeopiss ide ovdeeeeee opiss ide ovdeeeeee opiss ide ovdeeeeee opiss ide ovdeeeeee',
				'action',
				'j nolan',
				'c nolan',
				'wbros',
				'2008',
				'2h 32m',
				'https://m.media-amazon.com/images/M/MV5BMTMxNTMwODM0NF5BMl5BanBnXkFtZTcwODAyMTk2Mw@@._V1_UX182_CR0,0,182,268_AL_.jpg'))

		conn.commit()

		conn.close()
	except Exception as e:
		print(e)


if __name__ == '__main__':
	main2()
