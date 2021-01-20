import sqlite3
import urllib.request
from bs4 import BeautifulSoup

def scrapePage(pageAddress):
	req = urllib.request.Request(pageAddress, headers={'User-Agent': 'Mozilla/5.0'})
	page = urllib.request.urlopen(req)
	soup = BeautifulSoup(page, 'html.parser')

	filmInfo = dict()

	filmInfo["naslov"] = 'a'
	print(soup.find(class_='titleBar').find(class_='title_wrapper').find('h1'))
	filmInfo["opis"] = soup.find(class_='plot_summary_wrapper').find('div').find('div').string.strip()
	filmInfo["zanr"] = soup.find(class_='subtext').find('a').string
	filmInfo["scenarista"] = soup.find_all(class_='credit_summary_item')[1].find('a').string
	filmInfo["reziser"] = soup.find(class_='credit_summary_item').find('a').string
	filmInfo["producentska_kuca"] = 'Warner Bros.'
	filmInfo["godina_izdanja"] = soup.find(class_='title_wrapper').find('span').find('a').string
	filmInfo["trajanje"] =soup.find(class_='subtext').find('time').string.strip()
	filmInfo["pic"] = soup.find(class_='poster').find('img')['src']

	return filmInfo

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
			thumbnail text
			)
			''')


		c.execute("INSERT INTO film VALUES (?,?,?,?,?,?,?,?,?)", 
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
	except:
		pass

def main2():
	links=['https://www.imdb.com/title/tt0050083/?pf_rd_m=A2FGELUUNOQJNL&pf_rd_p=e31d89dd-322d-4646-8962-327b42fe94b1&pf_rd_r=JXG7QNRP47JK723EN190&pf_rd_s=center-1&pf_rd_t=15506&pf_rd_i=top&ref_=chttp_tt_5',\
	'https://www.imdb.com/title/tt0108052/?pf_rd_m=A2FGELUUNOQJNL&pf_rd_p=e31d89dd-322d-4646-8962-327b42fe94b1&pf_rd_r=JXG7QNRP47JK723EN190&pf_rd_s=center-1&pf_rd_t=15506&pf_rd_i=top&ref_=chttp_tt_6',\
	'https://www.imdb.com/title/tt0167260/?pf_rd_m=A2FGELUUNOQJNL&pf_rd_p=e31d89dd-322d-4646-8962-327b42fe94b1&pf_rd_r=JXG7QNRP47JK723EN190&pf_rd_s=center-1&pf_rd_t=15506&pf_rd_i=top&ref_=chttp_tt_7',\
	'https://www.imdb.com/title/tt0110912/?pf_rd_m=A2FGELUUNOQJNL&pf_rd_p=e31d89dd-322d-4646-8962-327b42fe94b1&pf_rd_r=JXG7QNRP47JK723EN190&pf_rd_s=center-1&pf_rd_t=15506&pf_rd_i=top&ref_=chttp_tt_8',\
	'https://www.imdb.com/title/tt0060196/?pf_rd_m=A2FGELUUNOQJNL&pf_rd_p=e31d89dd-322d-4646-8962-327b42fe94b1&pf_rd_r=JXG7QNRP47JK723EN190&pf_rd_s=center-1&pf_rd_t=15506&pf_rd_i=top&ref_=chttp_tt_9',\
	'https://www.imdb.com/title/tt0120737/?pf_rd_m=A2FGELUUNOQJNL&pf_rd_p=e31d89dd-322d-4646-8962-327b42fe94b1&pf_rd_r=JXG7QNRP47JK723EN190&pf_rd_s=center-1&pf_rd_t=15506&pf_rd_i=top&ref_=chttp_tt_10',\
]
	for linkAddress in links:
		try:
			filmInfo = scrapePage(linkAddress)

			print("INSERT INTO `filmovi`(`naslov`, `opis`, `zanr`, `scenarista`, \
				`reziser`, `producentska_kuca`, `godina_izdanja`, `trajanje`) VALUES \
				('"+filmInfo['naslov']+"','"+filmInfo['opis']+"','"+filmInfo['zanr']+"','"+filmInfo['scenarista']+"','"+filmInfo['reziser']+"','"+\
				filmInfo['producentska_kuca']+"',"+filmInfo['godina_izdanja']+",'"+filmInfo['trajanje']+"')")
		except:
			pass

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


if __name__ == '__main__':
	main3()
