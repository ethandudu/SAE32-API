name: Tests

on:
  push:
    branches: [ master ]
  pull_request:
    branches: [ master ]

jobs:
  deployment:
    runs-on: ubuntu-latest
    steps:
    - name: Test tests.php
      uses: fjogeleit/http-request-action@v1
      with:
        url: "${{ secrets.url }}/tests.php"
        method: 'GET'
        customHeaders: '{"Authorization": "Bearer ${{ secrets.token }}"}'
