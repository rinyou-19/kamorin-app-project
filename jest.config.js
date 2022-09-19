module.exports = {
    testEnvironment: 'jsdom',
    moduleNameMapper: { // テストファイル内で import 時のエイリアス（ここでは `@/` ）を使うのに必要
      '^@/(.*)$': '<rootDir>/resources/js/$1',
    },
    moduleFileExtensions: ['vue', 'ts', 'js', 'json'],
    transform: {
      '^.+\\.vue$': 'vue-jest',
      '^.+\\.ts$': 'ts-jest',
      '^.+\\.js$': 'babel-jest',
    },
    coverageDirectory: '<rootDir>/resources/coverage', // ルートには PHPUnit の tests/ があり混同しそうなため、resources/ 下へ
    transformIgnorePatterns: [ // @vue/test-utils を使うために必要
      'node_modules/(?!@ngrx|(?!deck.gl)|ng-dynamic)',
    ],
    collectCoverage: true,
    collectCoverageFrom: [ // どの階層のファイルからカバレッジを計算するか
      '<rootDir>/resources/js/*.vue',
    ],
    testRegex: "(/__tests__/.*|(\\.|/)(test|spec))\\.(jsx?|tsx?)$",
    preset: 'ts-jest'
  };