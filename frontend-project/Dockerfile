# FROM node:14-alpine as build-stage
# WORKDIR /app
# COPY ./frontend-project/package*.json ./
# RUN npm install
# COPY ./frontend-project/src ./src
# COPY . .
# COPY .babelrc .eslintrc.js .prettierrc.js ./
# RUN npm run build

# # Production stage
# FROM node:14-alpine as production-stage
# WORKDIR /app
# COPY --from=build-stage /app/dist .
# COPY ./frontend-project/package*.json ./
# RUN npm install --only=production
# RUN addgroup -S app && adduser -S -G app app
# USER app
# CMD ["npm", "run", "start"]
FROM node
RUN mkdir /usr/src/app
WORKDIR /usr/src/app

ENV PATH /usr/src/app/node_modules/.bin:$PATH

COPY ./frontend-project/package.json /usr/src/app/package.json
COPY ./frontend-project/* .
RUN npm install --force
RUN npm install -g @vue/cli
# start app
CMD ["npm", "run", "serve"]