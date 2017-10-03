pipeline {
  agent {
    dockerfile {
      filename 'Dockerfile'
    }
    
  }
  stages {
    stage('Test') {
      steps {
        sh '''cd app
php ./composer.phar install
./vendor/bin/phpunit ./test/ --log-junit test-results/result.xml
'''
      }
    }
    stage('Deploy') {
      steps {
        sh 'echo "hai"'
      }
    }
  }
}