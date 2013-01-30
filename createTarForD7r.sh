echo START
cd ..
tar cvzf d7r.tar.gz d7r
folder_name="$(date +%Y-%m-%d-%T)"
echo "new folder name is " $folder_name
mkdir /home/gerassimos/Desktop/d7r/backup/$folder_name
mv -v d7r.tar.gz  /home/gerassimos/Desktop/d7r/backup/$folder_name/
cp d7r/d7r-readme.txt /home/gerassimos/Desktop/d7r/backup/$folder_name/
echo FINISH

