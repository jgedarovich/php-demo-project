#!groovy

node ('deployhost') {

    stage('Checkout'){
        checkout scm
    }

    stage('Build'){
        sh '''
            docker build -t jgedarovich/php-dummy:${BUILD_ID} .
            docker push jgedarovich/php-dummy:${BUILD_ID}
            docker push jgedarovich/php-dummy:latest
        '''
    }

    stage('Test'){
        docker.image('jgedarovich/php-dummy:latest').inside {
            sh """
                cd app
                php ./composer.phar install
                ./vendor/bin/phpunit ./test/ --log-junit test-results/result.xml
            """
            junit 'app/test-results/result.xml'
        }
    }

    stage('Deploy'){
        withCredentials([string(credentialsId: 'GCLOUD_CREDS', variable: 'GCLOUD_CREDS')]) {
            docker.image('jgedarovich/gcloud-kubectl-make:latest').inside {
                sh """
                    echo ${GCLOUD_CREDS} | base64 -d > ${HOME}/gcp-key.json
                    gcloud auth activate-service-account --key-file ${HOME}/gcp-key.json
                    gcloud --quiet config set project etsy-gke-sandbox # maybe this should be baked in to the image
                    gcloud container clusters get-credentials gke-sandbox --zone us-central1-c --project etsy-gke-sandbox
                    kubectl set image deployment/jimbo-dummy-php-app app=jgedarovich/php-dummy:${BUILD_ID}
                """
            }
        }
    }

}
