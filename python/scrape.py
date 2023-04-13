import requests
from bs4 import BeautifulSoup
from datetime import datetime

# Set the URL for the website to scrape
url = 'https://www.basketball-reference.com/'

# Make a request to the website and get the HTML content
response = requests.get(url)

# Parse the HTML content using BeautifulSoup
soup = BeautifulSoup(response.content, 'html.parser')

# Get the current date and format it as 'YYYY-MM-DD'
today = datetime.now().strftime('%Y-%m-%d')

# Find all the game scores for the current date
scores = soup.find_all('div', {'class': 'game_summary expanded nohover'})

# Find all the winner and loser teams
winners = soup.find_all('tr', {'class': 'winner'})
losers = soup.find_all('tr', {'class': 'loser'})

# Loop through each game and extract the required data
for i, game in enumerate(scores):
    # Get the game date
    GameDate = today

    # Get the top and bottom scores of the game
    scores = game.find_all('td', {'class': 'right'})
    GameScore1 = scores[0].text.strip()
    GameScore2 = scores[2].text.strip()
    GameScore = GameScore1 + '-' + GameScore2

    # Get the team names
    Team1Name = winners[i].find('a').text.strip()
    Team2Name = losers[i].find('a').text.strip()

    # Set the Sport value as "NBA"
    Sport = "NBA"

    # Print the extracted data
    print('GameDate:', GameDate)
    print('GameScore:', GameScore)
    print('Team1Name:', Team1Name)
    print('Team2Name:', Team2Name)
    print('Sport:', Sport)
