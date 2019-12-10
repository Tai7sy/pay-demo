// for ide path resolve

const path = require('path');
const webpack = require('webpack');

module.exports = {
  resolve: {
    extensions: ['.js', '.vue', '.json'],
    alias: {
      'vue$': 'vue/dist/vue.esm.js',
      '@': path.join(__dirname, '../src'),
    },
  },
  plugins: [
    new webpack.DefinePlugin({
      'process.env': process.env
    }),
  ]
};
