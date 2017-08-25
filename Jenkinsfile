#!groovy
stage('Build') {
    kubernetes.pod('some_ephemeral_builder').withImage('russjt/docker-git-gcloud').inside {  
        //git 'https://github.com/jenkinsci/kubernetes-pipeline.git'
        checkout scm
        sh 'echo "BUILD: hello from some pod using russjt/docker-git-cloud"'
    }    
}
stage('Test') {
    kubernetes.pod('some_ephemeral_builder').withImage('russjt/docker-git-gcloud').inside {  
        //git 'https://github.com/jenkinsci/kubernetes-pipeline.git'
        sh 'echo "TEST: hello from some pod using russjt/docker-git-cloud"'
    }    
}
stage('Deploy') {
    kubernetes.pod('some_ephemeral_builder').withImage('russjt/docker-git-gcloud').inside {  
        //git 'https://github.com/jenkinsci/kubernetes-pipeline.git'
        sh 'echo "DEPLOY: hello from some pod using russjt/docker-git-cloud"'
    }    
}
/*
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
    
    /*
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
    }
}
    */
