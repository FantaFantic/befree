
import { DataColumn, DataRow, DataSettings, Filter } from "../../types/dataSettings";
import { DataSource, DataSourcesSettings, FileObject, SourceType } from "../../types/dataSource";
import { Sort, SortSetting } from "../../types/table";
import { areObjectsEqual } from "./table";

export const areDataSourcesEqual = (oldDataSource: DataSource, newDataSource: DataSource): boolean => {
  // Compare each property to check for equality
  return (
    oldDataSource.name === newDataSource.name &&
    oldDataSource.type === newDataSource.type &&
    areObjectsEqual(oldDataSource.sourceObject ?? {}, newDataSource.sourceObject ?? {}) &&
    areObjectsEqual(oldDataSource.savedSource ?? {}, newDataSource.savedSource ?? {})
  );
};

export type SparqlObject = {
  url: string; // sparql endpoint
  query: string; // sparql query
  lastFetched?: Date | string; // last time of sparql fetch
  fileType?: string;
}

export const getDefaultSourceObject = (sourceType: SourceType): any => {
  if (sourceType == SourceType.File) {
    return {
      file: undefined
    }
  }


  if (sourceType == SourceType.Sparql) {
    return {
      url: "https://dbpedia.org/sparql",
      query:
        `SELECT ?subject ?predicate ?object
    
  WHERE{
    ?subject ?predicate ?object.
  }`
    }
  }

  return {}
}

export const getDefaultDataSource = (): DataSource => {
  return {
    name: "New source",
    type: SourceType.Sparql,
    sourceObject: getDefaultSourceObject(SourceType.Sparql),
  };
}

export const  getSourceTypeFromString = (input: string): SourceType => {
  if(input == SourceType.Sparql){
    return SourceType.Sparql;
  }
  else{
    return SourceType.File;
  }
  
}

