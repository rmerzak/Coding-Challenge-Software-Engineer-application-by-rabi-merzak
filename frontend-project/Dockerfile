FROM node
RUN mkdir /usr/src/app
WORKDIR /usr/src/app

ENV PATH /usr/src/app/node_modules/.bin:$PATH

COPY package.json /usr/src/app/package.json
COPY . .
RUN npm install --force
RUN npm install -g @vue/cli
# start app
CMD ["npm", "run", "serve"]