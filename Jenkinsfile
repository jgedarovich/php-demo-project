#!groovy
podTemplate(
    label: 'spellcorrection-builder',
    containers: [
        containerTemplate(
            name: 'dind-gcloud', // used for building /push the container
            image: 'jgedarovich/docker-git-gcloud:latest',
            privileged: true,
            ttyEnabled: true,
            resourceRequestCpu: '200m',
            resourceLimitCpu: '200m',
            resourceRequestMemory: '4000Mi',
            resourceLimitMemory: '4000Mi',
            command: 'cat'
        ),
        containerTemplate( // created in first stage 
            name: 'php-ci-prod-jimbo',
            image: 'gcr.io/etsy-gke-sandbox/php-ci-prod-jimbo:latest',
            alwaysPullImage: true,
            ttyEnabled: true,
            resourceRequestCpu: '200m',
            resourceLimitCpu: '200m',
            resourceRequestMemory: '4000Mi',
            resourceLimitMemory: '4000Mi',
            workingDir: '/var/www/html',
            command: 'cat'
        ),

    ],
    volumes: [
        hostPathVolume(mountPath: '/var/run/docker.sock', hostPath: '/var/run/docker.sock'), // for dind bc privlidged alon isn't working...
        hostPathVolume(mountPath: '/var/lib/docker', hostPath: '/var/lib/docker'), // TODO: might not work
    ]
) {
    node('spellcorrection-builder') {
        /*stage('Build') {
            container('dind-gcloud') {
                //sh "ls -lrta /var/run/docker.sock"
                withCredentials([string(credentialsId: 'GCLOUD_CREDS', variable: 'GCLOUD_CREDS')]) { // TODO: the iam role associated with these creds requires storage admin 
                    checkout scm
                    sh """
                        export DOCKER_API_VERSION=1.23 #necessary for some reason otherwise get client/server mismatch
                        #ls -lrta /var/run/docker.sock
                        #docker images
                        #ls -lrta /usr/bin/gcloud
                        echo ${GCLOUD_CREDS}
                        echo ${GCLOUD_CREDS} | base64 -d > ${HOME}/gcp-key.json
                        #cat ${HOME}/gcp-key.json
                        gcloud auth activate-service-account --key-file ${HOME}/gcp-key.json
                        gcloud --quiet config set project etsy-gke-sandbox # maybe this should be baked in to the image
                        cd docker/prod && make deploy
                    """
                }
            }
        }*/
        stage('Test') {
            container('php-ci-prod-jimbo') {
                sh """
                cd /var/www/html
                mkdir test-results
                ./vendor/bin/phpunit ./test/ --log-junit test-results/result.xml
                ls -lrta test-results/
                cat test-results/result.xml
                ls -lrta /var/www/html/test-results
                cat /var/www/html/test-results/result.xml
                """
                archiveArtifacts artifacts: '/var/www/html/test-results/*'
                junit '/var/www/html/test-results/result.xml'
            }
        }
    }


}
