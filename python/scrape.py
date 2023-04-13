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

# Loop through each game and extract the required data
for game in scores:
    # Get the game date
    GameDate = today
    
    # Get the final score of the game
    GameScore = game.find('div', {'class': 'score'}).text.strip()
    
    # Get the name of the first team
    Team1Name = game.find('div', {'class': 'winner'}).find('a').text.strip()
    
    # Get the name of the second team
    Team2Name = game.find('div', {'class': 'loser'}).find('a').text.strip()
    
    # Find the NBA standings table
    standings = soup.find('table', {'id': 'confs_standings_E'})

    # Find the rows of the standings table
    rows = standings.find_all('tr')

    # Loop through each row and find the team's record
    for row in rows:
        # Get the team name
        team_name = row.find('a', {'class': 'team_name'})
        if team_name:
            team_name = team_name.text.strip()

            # Check if the team name matches Team1Name
            if team_name == Team1Name:
                # Get the team's W/L record
                Team1Record = row.find_all('td')[1].text.strip()
                break

    # Loop through each row and find the second team's record
    for row in rows:
        # Get the team name
        team_name = row.find('a', {'class': 'team_name'})
        if team_name:
            team_name = team_name.text.strip()

            # Check if the team name matches Team2Name
            if team_name == Team2Name:
                # Get the team's W/L record
                Team2Record = row.find_all('td')[1].text.strip()
                break

    # Set the Sport value as "NBA"
    Sport = "NBA"

    # Print the extracted data
    print('GameDate:', GameDate)
    print('GameScore:', GameScore)
    print('Team1Name:', Team1Name)
    print('Team2Name:', Team2Name)
    print('Team1Record:', Team1Record)
    print('Team2Record:', Team2Record)
    print('Sport:', Sport)
