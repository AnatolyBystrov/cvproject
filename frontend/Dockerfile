FROM node:20-alpine

WORKDIR /app

COPY . .

RUN npm install && npm run build


FROM nginx:stable-alpine
COPY --from=0 /app/build /usr/share/nginx/html

EXPOSE 3000
