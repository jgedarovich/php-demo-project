#!groovy
node {
 stages {
    stage('Build') {
      agent {
        docker {
          reuseNode true
          image 'russjt/docker-git-gcloud'
        }
      }
      steps {
        checkout scm
        sh 'cd docker/prod && make deploy'
      }
    }

    /*
    stage('Test') {
      agent {
        docker {
          reuseNode true
          image 'jimbo/php-dummy-image-prod'
        }
      }
      steps {
        sh """
            cd /var/www/html/ 
            mkdir test-results 
            ./vendor/bin/phpunit ./test/ --log-junit test-results/result.xml
        """
      }
    }
    
     stage('Deploy') {
      agent {
        docker {
          reuseNode true
          image 'jimbo/php-dummy-image-prod'
        }
      }
      steps {
        sh 'cd /var/www/html/ && mkdir test-results &&  ./vendor/bin/phpunit ./test/ --log-junit test-results/result.xml'
      }
    }
    */
    }
}
