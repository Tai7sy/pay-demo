const path = require('path');

module.exports = {
  lintOnSave: false,
  productionSourceMap: false,

  configureWebpack: () => {
    return require(path.resolve(__dirname, 'build/webpack.' + (process.env.NODE_ENV === 'production' ? 'prod' : 'dev') + '.conf.js'))
  },

  pluginOptions: {
    prerenderSpa: {
      registry: undefined,
      renderRoutes: [
        '/'
      ],
      useRenderEvent: true,
      headless: true,
      onlyProduction: true
    }
  }
};
