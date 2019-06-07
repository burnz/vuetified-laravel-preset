require("dotenv").config();

const env = process.env;
const EchoServer = require("laravel-echo-server");

const options = {
  authHost: env.APP_URL,
  devMode: env.APP_DEBUG,
  authEndpoint: "/broadcasting/auth",
  clients: {
    appId: env.ECHO_CLIENT_ID,
    key: env.ECHO_CLIENT_KEY
  },
  database: env.ECHO_DB ? env.ECHO_DB : "sqlite",
  databaseConfig: {
    redis: {},
    sqlite: {
      databasePath: "/database/laravel-echo-server.sqlite"
    }
  },
  host: env.ECHO_DOMAIN,
  port: env.ECHO_PORT ? env.ECHO_PORT : 6001,
  protocol: env.ECHO_PROTOCOL,
  // use valet secure command
  sslCertPath: env.ECHO_CERTPATH,
  sslKeyPath: env.ECHO_KEYPATH,
  sslCertChainPath: env.ECHO_CERTCHAINPATH,
  sslPassphrase: env.ECHO_PASSPHRASE,
  socketio: {},// https://github.com/socketio/engine.io#methods-1
  subscribers: {
    http: env.ECHO_SUB_HTTP ? env.ECHO_SUB_HTTP : false,
    redis: env.ECHO_SUB_REDIS ? env.ECHO_SUB_REDIS : false,
  },
  apiOriginAllow: {
    allowCors: env.ECHO_ALLOW_CORS,
    allowOrigin: env.ECHO_ALLOW_ORIGIN ? env.ECHO_ALLOW_ORIGIN : env.ECHO_PROTOCOL + '://' + ECHO_DOMAIN + ':80',
    allowMethods: env.ECHO_ALLOW_METHODS ? env.ECHO_ALLOW_METHODS : 'GET ,POST',
    allowHeaders: env.ECHO_ALLOW_HEADERS ? env.ECHO_ALLOW_HEADERS : 'Origin, Content-Type, X-Auth-Token, X-Requested-With, Accept, Authorization, X-CSRF-TOKEN, X-Socket-Id'
  }
};

EchoServer.run(options);