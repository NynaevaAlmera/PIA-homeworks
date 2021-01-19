import sqlite3
import urllib.request
from bs4 import BeautifulSoup

def scrapePage(pageAddress):
	req = urllib.request.Request(pageAddress, headers={'User-Agent': 'Mozilla/5.0'})
	page = urllib.request.urlopen(req)
	soup = BeautifulSoup(page, 'html.parser')

	filmInfo = dict()

	filmInfo["naslov"] = soup.find(class_='titleBar').find(class_='title_wrapper').find('h1').string
	print(soup.find(class_='titleBar').find(class_='title_wrapper'))
	filmInfo["opis"] = soup.find(class_='plot_summary_wrapper').find('div').find('div').string.strip()
	filmInfo["zanr"] = soup.find(class_='subtext').find('a').string
	filmInfo["scenarista"] = soup.find_all(class_='credit_summary_item')[1].find('a').string
	filmInfo["reziser"] = soup.find(class_='credit_summary_item').find('a').string
	filmInfo["producentska_kuca"] = 'Warner Bros.'
	filmInfo["godina_izdanja"] = int(soup.find(class_='title_wrapper').find('span').find('a').string)
	filmInfo["trajanje"] =soup.find(class_='subtext').find('time').string.strip()
	filmInfo["pic"] = soup.find(class_='poster').find('img')['src']

	return filmInfo

def main():
	base = "https://www.filmfreak.tv/watch/"

	conn = sqlite3.connect("databases/film.db")
	c = conn.cursor()
	c.execute('''DROP TABLE if exists film''')
	c.execute('''CREATE TABLE film (
		title text, 
		linktitle text, 
		description text)
		''')

	listAddress = 'https://www.filmfreak.tv/home/film-list'
	req = urllib.request.Request(listAddress, headers={'User-Agent': 'Mozilla/5.0'})
	page = urllib.request.urlopen(req)
	soup = BeautifulSoup(page, "html.parser")

	containerLeft = soup.find(class_='container-left')
	containerItems = containerLeft.find_all(class_='container-item')

	for item in containerItems:
		links = item.find_all("a")
		for link in links:
			linkAddress = link['href']
			filmInfo = scrapePage(linkAddress)

			c.execute("INSERT INTO film VALUES (?, ?, ?)", 
				(filmInfo['title'],
				filmInfo['linktitle'],
				filmInfo['description']))


			with open('pics/{}.jpg'.format(filmInfo["linktitle"]), 'wb') as f:
				req = urllib.request.Request(filmInfo['pic'], headers={'User-Agent': 'Mozilla/5.0'})
				page = urllib.request.urlopen(req)
				f.write(page.read())
		
	conn.commit()

	conn.close()

def main2():

	linkAddress = 'https://www.imdb.com/title/tt0468569/?pf_rd_m=A2FGELUUNOQJNL&pf_rd_p=e31d89dd-322d-4646-8962-327b42fe94b1&pf_rd_r=JXG7QNRP47JK723EN190&pf_rd_s=center-1&pf_rd_t=15506&pf_rd_i=top&ref_=chttp_tt_4'
	filmInfo = scrapePage(linkAddress)

	print(filmInfo)
	
if __name__ == '__main__':
	main2()
