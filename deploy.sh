#!/bin/bash

HOST="ftp.artseb.studio" # FTP server
USERNAME="cicd@ride.artseb.studio" # FTP username
PASSWORD="Ride@2025" # FTP password (replace with the actual password)
TARGETDIR="/ride.artseb.studio" # Target directory on the server

echo "Deploying code to cPanel..."

lftp -d -c "open -u $USERNAME,$PASSWORD $HOST; set ssl:verify-certificate no; mirror -R ./ $TARGETDIR --ignore-time --parallel=10 --exclude-glob .git* --exclude .github* --exclude deploy.sh --include-hidden"

echo "Deployment completed Successfully!"
