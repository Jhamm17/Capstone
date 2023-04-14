import requests
from bs4 import BeautifulSoup
from datetime import datetime
import mysql.connector

# Define the MySQL configuration
mysql_config = {
    'host': 'db.luddy.indiana.edu',
    'user': 'i494f22_team36',
    'password': 'my+sql=i494f22_team36',
    'database': 'i494f22_team36'
}

# Connect to the MySQL database
cnx = mysql.connector.connect(**mysql_config)
cursor = cnx.cursor()

# Delete all data from the iulive1 table
cursor.execute('DELETE FROM iulive1')

# Scrape NBA game scores
basketball_url = 'https://www.basketball-reference.com/'
basketball_response = requests.get(basketball_url)
basketball_soup = BeautifulSoup(basketball_response.content, 'html.parser')
today = datetime.now().strftime('%Y-%m-%d')
basketball_scores = basketball_soup.find_all('div', {'class': 'game_summary expanded nohover'})
basketball_winners = basketball_soup.find_all('tr', {'class': 'winner'})
basketball_losers = basketball_soup.find_all('tr', {'class': 'loser'})
for i, game in enumerate(basketball_scores):
    GameDate = today
    scores = game.find_all('td', {'class': 'right'})
    GameScore = f"{scores[0].text.strip()}-{scores[2].text.strip()}"
    Team1Name = basketball_winners[i].find('a').text.strip()
    Team2Name = basketball_losers[i].find('a').text.strip()
    Sport = "NBA"
    GameYesterday = "Y"
    if not GameScore or not Team1Name or not Team2Name:
        GameYesterday = "N"
    insert_query = f"INSERT INTO iulive1 (GameDate, GameScore, Sport, Team1Name, Team2Name, GameYesterday) VALUES ('{GameDate}', '{GameScore}', '{Sport}', '{Team1Name}', '{Team2Name}', '{GameYesterday}')"
    cursor.execute(insert_query)
    cnx.commit()

# Scrape NFL game scores
NFL_url = 'https://www.pro-football-reference.com/?utm_source=fb&utm_medium=sr_xsite&utm_campaign=2023_01_srnav&__hstc=218152582.3a2af2aff4ba586abeac5c278c105746.1681425539662.1681425539662.1681425539662.1&__hssc=218152582.6.1681425539662&__hsfp=3000179024'
NFL_response = requests.get(NFL_url)
NFL_soup = BeautifulSoup(NFL_response.content, 'html.parser')
today = datetime.now().strftime('%Y-%m-%d')
NFL_scores = NFL_soup.find_all('div', {'class': 'game_summary expanded nohover'})
NFL_winners = NFL_soup.find_all('tr', {'class': 'winner'})
NFL_losers = NFL_soup.find_all('tr', {'class': 'loser'})
for i, game in enumerate(NFL_scores):
    GameDate = today
    game_scores = game.find_all('td', {'class': 'right'})
    score1 = game_scores[0].text.strip()
    score2 = game_scores[2].text.strip()
    if score1 > score2:
        GameScore = f"{score1}-{score2}"
    else:
        GameScore = f"{score2}-{score1}"
    Team1Name = NFL_winners[i].find('a').text.strip()
    Team2Name = NFL_losers[i].find('a').text.strip()
    Sport = "NFL"
    GameYesterday = "Y"
    if not GameScore or not Team1Name or not Team2Name:
        GameYesterday = "N"
    insert_query = f"INSERT INTO iulive1 (GameDate, GameScore, Sport, Team1Name, Team2Name, GameYesterday) VALUES ('{GameDate}', '{GameScore}', '{Sport}', '{Team1Name}', '{Team2Name}', '{GameYesterday}')"
    cursor.execute(insert_query)
    cnx.commit()

# Scrape NHL Scores
NHL_url = 'https://www.hockey-reference.com/?utm_source=cbb&utm_medium=sr_xsite&utm_campaign=2023_01_srnav&__hstc=213859787.66a404567bc94bbe394eb0f2b7a07888.1681142467614.1681142467614.1681425457938.2&__hssc=213859787.1.1681425457938&__hsfp=3000179024'
NHL_response = requests.get(NHL_url)
NHL_soup = BeautifulSoup(NHL_response.content, 'html.parser')
today = datetime.now().strftime('%Y-%m-%d')
NHL_scores = NHL_soup.find_all('div', {'class': 'game_summary nohover'})
NHL_winners = NHL_soup.find_all('tr', {'class': 'winner'})
NHL_losers = NHL_soup.find_all('tr', {'class': 'loser'})
for i, game in enumerate(NHL_scores):
    GameDate = today
    game_scores = game.find_all('td', {'class': 'right'})
    score1 = game_scores[0].text.strip()
    score2 = game_scores[2].text.strip()
    if score1 > score2:
        GameScore = f"{score1}-{score2}"
    else:
        GameScore = f"{score2}-{score1}"
    Team1Name = NHL_winners[i].find('a').text.strip()
    Team2Name = NHL_losers[i].find('a').text.strip()
    Sport = "NHL"
    GameYesterday = "Y"
    if not GameScore or not Team1Name or not Team2Name:
        GameYesterday = "N"
    insert_query = f"INSERT INTO iulive1 (GameDate, GameScore, Sport, Team1Name, Team2Name, GameYesterday) VALUES ('{GameDate}', '{GameScore}', '{Sport}', '{Team1Name}', '{Team2Name}', '{GameYesterday}')"
    cursor.execute(insert_query)
    cnx.commit()

#Scrape MLB Scores
MLB_url = 'https://www.baseball-reference.com/?utm_source=hr&utm_medium=sr_xsite&utm_campaign=2023_01_srnav&__hstc=88549636.3a2af2aff4ba586abeac5c278c105746.1681425539662.1681425539662.1681425539662.1&__hssc=88549636.2.1681425539662&__hsfp=3000179024'
MLB_response = requests.get(MLB_url)
MLB_soup = BeautifulSoup(MLB_response.content, 'html.parser')
today = datetime.now().strftime('%Y-%m-%d')
MLB_scores = MLB_soup.find_all('div', {'class': 'game_summary nohover'})
MLB_winners = MLB_soup.find_all('tr', {'class': 'winner'})
MLB_losers = MLB_soup.find_all('tr', {'class': 'loser'})
for i, game in enumerate(MLB_scores):
    GameDate = today
    game_scores = game.find_all('td', {'class': 'right'})
    score1 = game_scores[0].text.strip()
    score2 = game_scores[2].text.strip()
    if score1 > score2:
        GameScore = f"{score1}-{score2}"
    else:
        GameScore = f"{score2}-{score1}"
    Team1Name = MLB_winners[i].find('a').text.strip()
    Team2Name = MLB_losers[i].find('a').text.strip()
    Sport = "MLB"
    if not GameScore or not Team1Name or not Team2Name:
        GameYesterday = "N"
    insert_query = f"INSERT INTO iulive1 (GameDate, GameScore, Sport, Team1Name, Team2Name, GameYesterday) VALUES ('{GameDate}', '{GameScore}', '{Sport}', '{Team1Name}', '{Team2Name}', '{GameYesterday}')"
    cursor.execute(insert_query)
    cnx.commit()

#Scraping NCAA Men's Basketball Scores

MCBB_url = 'https://www.sports-reference.com/cbb/boxscores/'
MCBB_response = requests.get(MCBB_url)
MCBB_soup = BeautifulSoup(MCBB_response.content, 'html.parser')
today = datetime.now().strftime('%Y-%m-%d')
MCBB_scores = MCBB_soup.find_all('div', {'class': 'game_summary nohover gender-m'})
MCBB_winners = MCBB_soup.find_all('tr', {'class': 'winner'})
MCBB_losers = MCBB_soup.find_all('tr', {'class': 'loser'})
for i, game in enumerate(MCBB_scores):
    GameDate = today
    game_scores = game.find_all('td', {'class': 'right'})
    score1 = game_scores[0].text.strip()
    score2 = game_scores[2].text.strip()
    if score1 > score2:
        GameScore = f"{score1}-{score2}"
    else:
        GameScore = f"{score2}-{score1}"
    Team1Name = MCBB_winners[i].find('a').text.strip()
    Team2Name = MCBB_losers[i].find('a').text.strip()
    Sport = "MCBB"
    GameYesterday = "Y"
    if not GameScore or not Team1Name or not Team2Name:
        GameYesterday = "N"
    insert_query = f"INSERT INTO iulive1 (GameDate, GameScore, Sport, Team1Name, Team2Name, GameYesterday) VALUES ('{GameDate}', '{GameScore}', '{Sport}', '{Team1Name}', '{Team2Name}', '{GameYesterday}')"
    cursor.execute(insert_query)
    cnx.commit()

# Scraping Women's College Basketball Scores

WCBB_url = 'https://www.sports-reference.com/cbb/boxscores/index.cgi?month=04&day=2&year=2023'
WCBB_response = requests.get(WCBB_url)
WCBB_soup = BeautifulSoup(WCBB_response.content, 'html.parser')
today = datetime.now().strftime('%Y-%m-%d')
WCBB_scores = WCBB_soup.find_all('div', {'class': 'game_summary nohover gender-f'})
WCBB_winners = WCBB_soup.find_all('tr', {'class': 'winner'})
WCBB_losers = WCBB_soup.find_all('tr', {'class': 'loser'})
for i, game in enumerate(WCBB_scores):
    GameDate = today
    game_scores = game.find_all('td', {'class': 'right'})
    score1 = game_scores[0].text.strip()
    score2 = game_scores[2].text.strip()
    if score1 > score2:
        GameScore = f"{score2}-{score1}"
    else:
        GameScore = f"{score1}-{score2}"
    Team1Name = WCBB_winners[i].find('a').text.strip()
    Team2Name = WCBB_losers[i].find('a').text.strip()
    Sport = "WCBB"
    GameYesterday = "Y"
    if not GameScore or not Team1Name or not Team2Name:
        GameYesterday = "N"
    insert_query = f"INSERT INTO iulive1 (GameDate, GameScore, Sport, Team1Name, Team2Name, GameYesterday) VALUES ('{GameDate}', '{GameScore}', '{Sport}', '{Team1Name}', '{Team2Name}', '{GameYesterday}')"
    cursor.execute(insert_query)
    cnx.commit()

# Scraping College Football Scores
CFB_url = 'https://www.sports-reference.com/cfb/'
CFB_response = requests.get(CFB_url)
CFB_soup = BeautifulSoup(CFB_response.content, 'html.parser')
today = datetime.now().strftime('%Y-%m-%d')
CFB_scores = CFB_soup.find_all('div', {'class': 'game_summary nohover'})
for game in CFB_scores:
    GameDate = today
    game_scores = game.find_all('td', {'class': 'right'})
    score1 = game_scores[0].text.strip()
    score2 = game_scores[2].text.strip()
    if score1 > score2:
        GameScore = f"{score1}-{score2}"
    else:
        GameScore = f"{score2}-{score1}"
    Team1Name = game.find_all('a')[0].text.strip()
    Team2Name = game.find_all('a')[2].text.strip()
    Sport = "CFB"
    GameYesterday = "Y"
    if not GameScore or not Team1Name or not Team2Name:
        GameYesterday = "N"
    insert_query = f"INSERT INTO iulive1 (GameDate, GameScore, Sport, Team1Name, Team2Name, GameYesterday) VALUES ('{GameDate}', '{GameScore}', '{Sport}', '{Team1Name}', '{Team2Name}', '{GameYesterday}')"
    cursor.execute(insert_query)
    cnx.commit()

# Close the MySQL connection
cursor.close()
cnx.close()