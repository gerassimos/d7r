echo START
cd ../..
tar cvzf d7r.tar.gz d7r
folder_name="$(date +%Y-%m-%d-%T)"
echo "new folder name is " $folder_name
mkdir ../backup/$folder_name
mv -v d7r.tar.gz  ../backup/$folder_name
cp d7r/sites/d7r-readme.txt ../backup/$folder_name/
echo FINISH

