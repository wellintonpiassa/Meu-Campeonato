import random

# gols marcados
homeScores = random.randrange(0, 5, 1)
visitantScores = random.randrange(0, 5, 1)

# Se der empate, vai para os pênaltis
if homeScores == visitantScores:
  homeConvertedPenalties = 0
  visitantConvertedPenalties = 0

  while homeConvertedPenalties == visitantConvertedPenalties:
    homeConvertedPenalties = random.randrange(3, 6, 1)
    visitantConvertedPenalties = random.randrange(3, 6, 1)

  print(homeScores, visitantScores, homeConvertedPenalties, visitantConvertedPenalties, end="")

else:
  print(homeScores, visitantScores, end="")