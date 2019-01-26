const path = require('path');

module.exports = {
  entry: './assets/js/app.js',
  output: {
    path: path.join(__dirname + '/assets/js/dist'),
    filename: 'index_bundle.js',
  },
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /node_modules/,
        use: {
          loader: 'babel-loader',
        }
      }
    ]
  }
}