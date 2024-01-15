FROM node:20.11.0

RUN mkdir /usr/src/app && mkdir /usr/src/app/frontend
 
WORKDIR /usr/src/app/frontend

RUN npm install -g @angular/cli@16

COPY . .